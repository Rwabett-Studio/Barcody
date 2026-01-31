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
use BaconQrCode\Renderer\Image\PngRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Writer;

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
    
    
    
    // api 
    
    
    public function apisendInvitations(Request $request, Event $event)
    {
        $request->validate([
            'contacts' => 'required|array',
            'contacts.*' => 'exists:contacts,id,event_id,'.$event->id
        ]);

        $results = [];
        $contacts = Contact::whereIn('id', $request->contacts)->get();

        foreach ($contacts as $contact) {
            try {
                $contact->markAsInvited();
                
                $message = $this->buildInvitationMessage($contact, $event);
                $sendResult = $this->sendWhatsappMessage($contact->phone, $message);
                
                $results[] = $sendResult['success'] 
                    ? $this->prepareResult($contact, $sendResult)
                    : $this->prepareErrorResult($contact, $sendResult['error'] ?? 'Failed to send');
                
            } catch (\Exception $e) {
                $results[] = $this->prepareErrorResult($contact, 'System error: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Invitation processing completed',
            'data' => $results
        ]);
    }

    public function apishowInvitationResponse($contact_id)
    {
        try {
            $contact = Contact::findOrFail($contact_id);
            return response()->json([
                'success' => true,
                'data' => [
                    'contact_name' => $contact->name,
                    'event_name' => $contact->event->name,
                    'response_url' => url('/api/invitations/'.$contact_id.'/response')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid invitation link'
            ], 404);
        }
    }

    public function apiprocessResponse(Request $request, $contact_id)
    {
        $request->validate([
            'response' => 'required|in:accepted,declined'
        ]);

        $contact = Contact::findOrFail($contact_id);
        
        if ($request->input('response') === 'accepted') {
            $contact->markAsAccepted();
        } else {
            $contact->markAsDeclined();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Response recorded successfully',
            'data' => [
                'contact_name' => $contact->name,
                'event_name' => $contact->event->name,
                'response' => $request->input('response'),
                'thank_you_url' => url('/api/invitations/thank-you?response='.$request->input('response'))
            ]
        ]);
    }

    public function apishowThankYouPage(Request $request)
    {
        $response = $request->query('response');
        
        if (!in_array($response, ['accepted', 'declined'])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid response type'
            ], 400);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your response',
            'data' => [
                'response' => $response,
                'message' => $response === 'accepted' 
                    ? 'We look forward to seeing you at the event!'
                    : 'We regret you won\'t be able to join us.'
            ]
        ]);
    }



///////////////////////////////////////////

public function sendQrCodes(Request $request, Event $event)
{
    $request->validate([
        'contacts' => 'required|array',
        'contacts.*' => 'exists:contacts,id,event_id,' . $event->id
    ]);

    $results = [];
    $contacts = Contact::whereIn('id', $request->contacts)->get();

    foreach ($contacts as $contact) {
        try {
            // Mark as invited
            $contact->markAsInvited();

            // Generate QR URL
            $qrUrl = route('invitation.response', ['contact_id' => $contact->id]);

            // Generate QR Code as PNG using GD backend
            $qrRawPng = $this->generateQrCodePng($qrUrl);

            // Save PNG to public disk
            $fileName = 'qrcodes/' . $contact->id . '_' . time() . '.png';
            Storage::disk('public')->put($fileName, $qrRawPng);

            // Public URL
            $qrImageUrl = asset('storage/' . $fileName);

            // WhatsApp caption
            $caption = "🎉 *دعوة خاصة لحضور الفعالية*\n\n" .
                       "👤 الاسم: {$contact->name}\n" .
                       "📍 الفعالية: {$event->name}\n\n" .
                       "📲 امسح رمز الاستجابة السريعة (QR) لحضور الفعالية\n\nنأمل رؤيتك قريبًا!";

            // Send via WhatsApp API
            $sendResult = $this->sendWhatsappImage($contact->phone, $qrImageUrl, $caption);

            $results[] = [
                'contact' => $contact->name,
                'phone' => $contact->phone,
                'status' => $sendResult['success'] ? 'success' : 'failed',
                'message' => $sendResult['success'] ? 'QR sent successfully' : ($sendResult['error'] ?? 'Failed to send')
            ];
        } catch (\Exception $e) {
            $results[] = [
                'contact' => $contact->name,
                'phone' => $contact->phone,
                'status' => 'failed',
                'message' => 'System error: ' . $e->getMessage()
            ];
        }
    }

    return response()->json([
        'message' => 'QR code sending completed',
        'data' => $results
    ]);
}

private function generateQrCodePng($text)
{
    $renderer = new PngRenderer(
        new RendererStyle(300),
        new GdImageBackEnd()
    );

    $writer = new Writer($renderer);
    return $writer->writeString($text);
}

private function sendWhatsappImage($phone, $imageUrl, $caption)
{
    try {
        $client = new Client(['timeout' => 30, 'verify' => false]);

        $formattedPhone = $this->formatPhoneNumber($phone);

        $response = $client->post(env('WHATSAPP_API_URL'), [
            'form_params' => [
                'number' => $formattedPhone,
                'type' => 'media',
                'message' => $caption,
                'media_url' => $imageUrl,
                'instance_id' => env('WHATSAPP_INSTANCE_ID'),
                'access_token' => env('WHATSAPP_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return [
            'success' => $response->getStatusCode() === 200 && ($data['status'] ?? false),
            'error' => $data['message'] ?? null
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'error' => 'Failed to send image: ' . $e->getMessage()
        ];
    }
}





public function sendInvitations(Request $request, Event $event)
{
    $request->validate([
        'contacts' => 'required|array',
        'contacts.*' => 'exists:contacts,id,event_id,'.$event->id
    ]);

    $results = [];
    $contacts = Contact::whereIn('id', $request->contacts)->get();

    foreach ($contacts as $contact) {
        try {
            $contact->markAsInvited();
            
            $message = $this->buildInvitationMessage($contact, $event);
            $sendResult = $this->sendWhatsappMessage($contact->phone, $message);
            
            $results[] = [
                'contact' => $contact->name,
                'phone' => $contact->phone,
                'status' => $sendResult['success'] ? 'success' : 'failed',
                'message' => $sendResult['success'] ? 'Invitation sent' : ($sendResult['error'] ?? 'Failed to send')
            ];
            
        } catch (\Exception $e) {
            $results[] = [
                'contact' => $contact->name,
                'phone' => $contact->phone,
                'status' => 'failed',
                'message' => 'System error: ' . $e->getMessage()
            ];
        }
    }

    return response()->json([
        'message' => 'Invitation processing completed',
        'results' => $results
    ]);
}

private function buildInvitationMessage($contact, $event)
{
    $responseLink = route('invitation.response', ['contact_id' => $contact->id]);
    
    // Format for WhatsApp clickable link
    $clickableLink = "Click here to respond: " . $responseLink;
    
    return "📣 *Invitation Notification* 📣\n\n" .
           "Dear {$contact->name},\n\n" .
           "You're invited to:\n" .
           "✨ *Event:* {$event->name}\n" .
           "📅 *Date:* {$event->date}\n" .
           "📍 *Location:* {$event->location}\n\n" .
           $clickableLink . "\n\n" .
           "Or copy this link if not clickable:\n" .
           $responseLink;
}
private function sendWhatsappMessage($phone, $message)
{
    try {
        $client = new Client([
            'timeout' => 30,
            'verify' => false,
        ]);

        $formattedPhone = $this->formatPhoneNumber($phone);

        $response = $client->post(env('WHATSAPP_API_URL'), [
            'form_params' => [
                'number' => $formattedPhone,
                'message' => $message,
                'instance_id' => env('WHATSAPP_INSTANCE_ID'),
                'access_token' => env('WHATSAPP_API_KEY')
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);
        
        return [
            'success' => $response->getStatusCode() === 200 && ($responseData['status'] ?? false),
            'error' => $responseData['message'] ?? null
        ];

    } catch (\Exception $e) {
        return [
            'success' => false,
            'error' => 'API connection failed: ' . $e->getMessage()
        ];
    }
}



public function showInvitationResponse($contact_id)
{
    try {
        $contact = Contact::findOrFail($contact_id);
        return view('invitations.response', ['contact_id' => $contact_id]);
    } catch (\Exception $e) {
        return view('invitations.error', [
            'message' => 'Invalid invitation link. Please contact the event organizer.'
        ]);
    }
}

public function processResponse(Request $request, $contact_id)
{
    $contact = Contact::findOrFail($contact_id);
    
    if ($request->input('response') === 'accepted') {
        $contact->markAsAccepted();
    } else {
        $contact->markAsDeclined();
    }
    
    return response()->noContent(); // Returns HTTP 204
}

public function showThankYouPage(Request $request)
{
    $response = $request->query('response');
    
    if (!in_array($response, ['accept', 'decline'])) {
        abort(400, 'Invalid response type');
    }
    
    return view('invitations.thankyou', [
        'response' => $response
    ]);
}

    private function prepareResult($contact, $sendResult)
    {
        return [
            'contact' => $contact->name,
            'phone' => $contact->phone,
            'status' => $sendResult['success'] ? 'success' : 'failed',
            'message' => $sendResult['success'] ? 'Sent successfully' : ($sendResult['error'] ?? 'Failed to send')
        ];
    }

    private function prepareErrorResult($contact, $errorMessage)
    {
        return [
            'contact' => $contact->name,
            'phone' => $contact->phone,
            'status' => 'failed',
            'message' => $errorMessage
        ];
    }
    
    
    /////////////////// qr ////////////////////
    
    


    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '966' . substr($phone, 1); // Saudi Arabia country code
        }
        return $phone;
    }


}