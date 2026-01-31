<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Contact;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function updateStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:accepted,declined,canceled'
        ]);

        // Update contact status
        if ($request->status === 'accepted') {
            $contact->markAsAccepted();
        } elseif ($request->status === 'declined') {
            $contact->markAsDeclined();
        } else {
            $contact->markAsCanceled();
        }

        // Create notification
        Notification::create([
            'contact_id' => $contact->id,
            'event_id' => $contact->event_id,
            'type' => 'response',
            'message' => "Contact {$contact->name} has {$request->status} the invitation",
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully');
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read');
    }
    
    
    
public function index(Request $request)
{
    $query = Notification::with(['contact', 'event']);
    
    // Filter by status
    if ($request->has('status')) {
        $query->where('status', $request->status);
    }
    
    // Filter by type
    if ($request->has('type')) {
        $query->where('type', $request->type);
    }
    
    // Filter by read status
    if ($request->has('read')) {
        if ($request->read == 'true') {
            $query->whereNotNull('read_at');
        } else {
            $query->whereNull('read_at');
        }
    }

    $notifications = $query->latest()->paginate(10);

    return response()->json([
        'success' => true,
        'data' => $notifications
    ]);
}
}