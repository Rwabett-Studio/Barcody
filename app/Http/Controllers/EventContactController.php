<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
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


}


