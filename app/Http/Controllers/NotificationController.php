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

    /**
     * Dashboard view of all invitation responses / notifications.
     */
    public function dashboard(Request $request)
    {
        $query = Notification::with(['contact', 'event'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        $notifications = $query->paginate(20);

        $stats = [
            'total'    => Notification::count(),
            'accepted' => Notification::where('status', 'accepted')->count(),
            'maybe'    => Notification::where('status', 'maybe')->count(),
            'declined' => Notification::where('status', 'declined')->count(),
            'unread'   => Notification::whereNull('read_at')->count(),
        ];

        $events = \App\Models\Event::orderBy('name')->get(['id', 'name']);

        return view('admin.notifications.index', compact('notifications', 'stats', 'events'));
    }

    /**
     * Unread count for the navbar badge (JSON).
     */
    public function unreadCount()
    {
        return response()->json(['count' => Notification::whereNull('read_at')->count()]);
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