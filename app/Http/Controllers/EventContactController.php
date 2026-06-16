<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class EventContactController extends Controller
{
    public function index(Event $event)
    {
        $contacts = Contact::where('event_id', $event->id)->get();
        return view('admin.contactsevent.event', compact('contacts', 'event'));
    }

    public function create(Event $event)
    {
        return view('admin.contactsevent.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs',
            'phone' => 'required|string|unique:contacts,phone',
        ]);

        Contact::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'event_id' => $event->id
        ]);

        return redirect()->route('event.detail', $event->id)
                      ->with('success', 'Contact created successfully.');
    }

    public function edit(Event $event, Contact $contact)
    {
        return view('admin.contactsevent.edit', compact('event', 'contact'));
    }

    public function update(Request $request, Event $event, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs',
            'phone' => 'required|string|unique:contacts,phone,' . $contact->id,
        ]);

        $contact->update($request->only(['name', 'gender', 'phone']));

        return redirect()->route('event.detail', $event->id)
                      ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Event $event, Contact $contact)
    {
        $contact->delete();
        return redirect()->route('event.detail', $event->id)
                      ->with('success', 'Contact deleted successfully.');
    }

    public function showImportForm(Event $event)
    {
        return view('admin.contactsevent.import', compact('event'));
    }

    public function import(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new ContactsImport($event->id), $request->file('file'));

        return redirect()->route('event.detail', $event->id)
                      ->with('success', 'Contacts imported successfully.');
    }
    
    // API Methods
    
    public function sendInvitations(Request $request, Event $event)
    {
        $request->validate([
            'contacts' => 'required|array',
            'contacts.*' => 'exists:contacts,id,event_id,' . $event->id
        ]);

        $contacts = Contact::whereIn('id', $request->contacts)->get();
        $results = [];

        foreach ($contacts as $contact) {
            try {
                // علمه إنه تمت دعوته
                $contact->markAsInvited();

                // إرسال الدعوة (مرة واحدة فقط)
                $sendResult = $this->sendWhatsappTemplateMessage($contact->phone, $contact, $event);

                $results[] = [
                    'contact' => $contact->name,
                    'phone'   => $contact->phone,
                    'status'  => $sendResult['success'] ? 'success' : 'failed',
                    'message' => $sendResult['success'] ? 'تم الإرسال' : ($sendResult['error'] ?? 'فشل الإرسال')
                ];

            } catch (\Exception $e) {
                $results[] = [
                    'contact' => $contact->name,
                    'phone'   => $contact->phone,
                    'status'  => 'failed',
                    'message' => 'System error: ' . $e->getMessage()
                ];
            }
        }

        return response()->json([
            'message' => 'تمت معالجة الدعوات',
            'results' => $results
        ]);
    }

private function sendWhatsappTemplateMessage($phone, $contact, $event)
{
    try {
        $client = new \GuzzleHttp\Client([
            'timeout' => 30,
            'verify'  => false,
        ]);

        $formattedPhone = preg_replace('/[^0-9]/', '', $phone);

        $imageUrl = "https://onsyntax.com/front-end/img/hero_mob.png";

        $requestData = [
            "token" => env("WHATSAPP_API_TOKEN"),
            "phone" => $formattedPhone,
            "template_name" => "waled_text",
            "template_language" => "ar",
            "components" => [
                [
                    "type" => "header",
                    "parameters" => [
                        [
                            "type" => "image",
                            "image" => [
                                "link" => $imageUrl
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "body",
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => $contact->name
                        ]
                    ]
                ]
            ]
        ];

        $response = $client->post(
            "https://app.chatberry.net/api/wpbox/sendtemplatemessage",
            [
                "headers" => [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                "json" => $requestData
            ]
        );

        $responseBody = json_decode($response->getBody()->getContents(), true);

        return [
            "success" => $response->getStatusCode() === 200
                && ($responseBody['status'] ?? false),
            "error" => $responseBody['message'] ?? null,
        ];

    } catch (\Exception $e) {
        Log::error('WhatsApp Template Send Failed', [
            'error' => $e->getMessage(),
            'phone' => $phone,
        ]);

        return [
            "success" => false,
            "error" => $e->getMessage(),
        ];
    }
}





public function handlewebhook(Request $request)
{
    Log::info('Raw Webhook Data:', $request->all());

    try {
        $entry = $request->input('entry')[0]['changes'][0]['value'] ?? null;

        if (isset($entry['messages'][0]['type']) && $entry['messages'][0]['type'] === 'button') {
            $message = $entry['messages'][0];
            $buttonText = $message['button']['text'] ?? null;
            $phone = $message['from'] ?? null;

            Log::info('Button Press Detected', [
                'phone' => $phone,
                'button' => $buttonText,
            ]);

            if ($phone && $buttonText) {
                $status = null;

                if (stripos($buttonText, 'حضور') !== false) {
                    $status = 'accepted';
                } elseif (stripos($buttonText, 'اعتذار') !== false) {
                    $status = 'declined';
                }

                if ($status) {
                    DB::table('contacts')
                        ->where('phone', $phone)
                        ->update(['status' => $status]);

                    Log::info('Status Updated Successfully', [
                        'phone' => $phone,
                        'status' => $status,
                    ]);
                }

                // 🟢 إرسال الرسالة الثانية بعد اختيار "حضور"
                if ($status === 'accepted') {
                    $this->sendAttendanceOptions($phone);
                }
            }
        }

    } catch (\Exception $e) {
        Log::error('Webhook Processing Error: ' . $e->getMessage());
    }

    return response()->json(['success' => true]);
}


private function sendAttendanceOptions($phone)
{
    try {
        $client = new \GuzzleHttp\Client(['timeout' => 30, 'verify' => false]);
        $formattedPhone = preg_replace('/[^0-9]/', '', $phone);

        $requestData = [
            "token" => env("WHATSAPP_API_TOKEN"),
            "phone" => $formattedPhone,
            "message" => "يرجى اختيار عدد الأشخاص الذين سيحضرون 👇",
            "header" => "تأكيد الحضور",
            "footer" => "شكراً لتعاونك ❤️",
            "action" => [
                "button" => "اختيار العدد",
                "sections" => [
                    [
                        "title" => "عدد الحضور",
                        "rows" => [
                            ["id" => "1", "title" => "شخص واحد"],
                            ["id" => "2", "title" => "شخصان"],
                            ["id" => "3", "title" => "3 أشخاص"],
                        ]
                    ]
                ]
            ]
        ];

        $response = $client->post("https://app.chatberry.net/api/wpbox/sendmessage", [
            "headers" => [
                "Content-Type" => "application/json",
                "Accept" => "application/json"
            ],
            "json" => $requestData
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        Log::info('Attendance List Message Sent', [
            'phone' => $phone,
            'response' => $body,
        ]);

        return $body;

    } catch (\Exception $e) {
        Log::error('Failed to send attendance options: ' . $e->getMessage());
    }
}






    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);



        return $phone;
    }

    /* =====================================================================
     |  RSVP INVITATION FLOW (link -> attend/maybe/decline -> QR + notify)
     ===================================================================== */

    /**
     * Resolve a contact from either its invitation_token or numeric id.
     */
    private function resolveContact($identifier): ?Contact
    {
        return Contact::with('event')
            ->where('invitation_token', $identifier)
            ->orWhere('id', $identifier)
            ->first();
    }

    /**
     * Public landing page the guest opens from the WhatsApp link.
     */
    public function showInvitationResponse($contact_id)
    {
        $contact = $this->resolveContact($contact_id);

        if (!$contact || !$contact->event) {
            abort(404, 'Invitation not found');
        }

        $event = $contact->event;

        return view('invitations.response', compact('contact', 'event'));
    }

    /**
     * Guest submits their response. Records status, fires a notification,
     * and (if attending / maybe) generates + sends the QR code.
     */
    public function processResponse(Request $request, $contact_id)
    {
        $request->validate([
            'status'       => 'required|in:accepted,maybe,declined',
            'guests_count' => 'nullable|integer|min:1|max:50',
        ]);

        $contact = $this->resolveContact($contact_id);
        if (!$contact || !$contact->event) {
            abort(404, 'Invitation not found');
        }

        $this->applyResponse($contact, $request->status, $request->guests_count);

        return redirect()->route('invitation.thankyou', ['status' => $request->status]);
    }

    /**
     * Shared logic for both web + API responses.
     * Returns the (possibly generated) public QR url or null.
     */
    private function applyResponse(Contact $contact, string $status, $guestsCount = null): ?string
    {
        switch ($status) {
            case 'accepted':
                $contact->markAsAccepted();
                break;
            case 'maybe':
                $contact->markAsMaybe();
                break;
            default:
                $contact->markAsDeclined();
                break;
        }

        if ($guestsCount) {
            $contact->update(['guests_count' => $guestsCount]);
        }

        // Notify the event owner of the response (dashboard + API)
        Notification::create([
            'contact_id' => $contact->id,
            'event_id'   => $contact->event_id,
            'type'       => Notification::TYPE_RESPONSE,
            'message'    => $this->responseMessage($contact, $status),
            'status'     => $status,
        ]);

        // Attending / maybe -> generate & send QR
        $qrUrl = null;
        if ($contact->shouldReceiveQr()) {
            $qrUrl = $this->generateQrForContact($contact);
            $this->sendQrViaWhatsapp($contact, $qrUrl);
        }

        return $qrUrl;
    }

    private function responseMessage(Contact $contact, string $status): string
    {
        $map = [
            'accepted' => 'أكّد الحضور',
            'maybe'    => 'احتمال يحضر',
            'declined' => 'اعتذر عن الحضور',
        ];
        $label = $map[$status] ?? $status;
        return "{$contact->name} - {$label}";
    }

    /**
     * Generate a QR (encoding the contact's check-in url) and store it.
     */
    private function generateQrForContact(Contact $contact): string
    {
        $checkinPayload = url('/invitation/checkin/' . $contact->invitation_token);

        // endroid/qr-code uses GD (no imagick dependency)
        $result = \Endroid\QrCode\Builder\Builder::create()
            ->writer(new \Endroid\QrCode\Writer\PngWriter())
            ->data($checkinPayload)
            ->size(400)
            ->margin(10)
            ->build();

        $png = $result->getString();

        $dir = 'qrcodes';
        Storage::disk('public')->makeDirectory($dir);
        $path = $dir . '/contact_' . $contact->id . '.png';
        Storage::disk('public')->put($path, $png);

        $contact->update(['qr_path' => $path]);

        return Storage::disk('public')->url($path);
    }

    private function sendQrViaWhatsapp(Contact $contact, string $qrUrl): void
    {
        try {
            $client = new \GuzzleHttp\Client(['timeout' => 30, 'verify' => false]);
            $phone  = preg_replace('/[^0-9]/', '', $contact->phone);

            $client->post('https://app.chatberry.net/api/wpbox/sendmessage', [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'json'    => [
                    'token'   => env('WHATSAPP_API_TOKEN'),
                    'phone'   => $phone,
                    'message' => "شكراً {$contact->name}! هذا رمز الدخول (QR) الخاص بك للحفل. أبرزه عند الوصول.",
                    'media_url' => $qrUrl,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send QR via WhatsApp: ' . $e->getMessage(), ['contact' => $contact->id]);
        }
    }

    public function showThankYouPage(Request $request)
    {
        $status = $request->query('status', 'accepted');
        return view('invitations.thankyou', compact('status'));
    }

    /**
     * Admin: bulk (re)send QR codes to attending / maybe contacts of an event.
     */
    public function sendQrCodes(Request $request, Event $event)
    {
        $contacts = Contact::where('event_id', $event->id)
            ->whereIn('status', [Contact::STATUS_ACCEPTED, Contact::STATUS_MAYBE])
            ->get();

        $results = [];
        foreach ($contacts as $contact) {
            $qrUrl = $this->generateQrForContact($contact);
            $this->sendQrViaWhatsapp($contact, $qrUrl);
            $results[] = ['contact' => $contact->name, 'phone' => $contact->phone, 'qr' => $qrUrl];
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'sent' => count($results), 'results' => $results]);
        }

        return back()->with('success', count($results) . ' QR codes sent.');
    }

    /* ----------------------------- API versions ----------------------------- */

    public function apiSendInvitations(Request $request, Event $event)
    {
        return $this->sendInvitations($request, $event);
    }

    /**
     * API: guest submits response. Returns the QR url when attending/maybe.
     */
    public function apiProcessResponse(Request $request, $contact_id)
    {
        $request->validate([
            'status'       => 'required|in:accepted,maybe,declined',
            'guests_count' => 'nullable|integer|min:1|max:50',
        ]);

        $contact = $this->resolveContact($contact_id);
        if (!$contact || !$contact->event) {
            return response()->json(['success' => false, 'message' => 'Invitation not found'], 404);
        }

        $qrUrl = $this->applyResponse($contact, $request->status, $request->guests_count);

        return response()->json([
            'success'  => true,
            'message'  => 'Response recorded',
            'status'   => $contact->fresh()->status,
            'qr_code'  => $qrUrl,
            'contact'  => $contact->only(['id', 'name', 'phone', 'status', 'guests_count']),
        ]);
    }

    public function apiShowThankYouPage()
    {
        return response()->json(['success' => true, 'message' => 'Thank you for your response']);
    }

    /**
     * Public check-in scan endpoint (admin scans the QR at the door).
     */
    public function checkin($token)
    {
        $contact = Contact::with('event')->where('invitation_token', $token)->first();
        if (!$contact) {
            abort(404, 'Invalid QR');
        }

        return response()->json([
            'success' => true,
            'contact' => $contact->only(['id', 'name', 'phone', 'status', 'guests_count']),
            'event'   => $contact->event->only(['id', 'name', 'date', 'location']),
        ]);
    }
}


