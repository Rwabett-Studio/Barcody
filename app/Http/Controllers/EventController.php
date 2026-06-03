<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['category', 'user'])->get();
        $qrCodes = [];

        foreach ($events as $event) {
            $qrData = "Event Name: {$event->name}\n";
            $qrData .= "Date: {$event->date}\n";
            $qrData .= "Time: {$event->time}\n";
            $qrData .= "Location: {$event->location}\n";

            $qrCodes[$event->id] = QrCode::encoding('UTF-8')->size(220)->generate($qrData);
        }
        
        return view('admin.events.index', compact('events', 'qrCodes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'maps' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft',
        ]);

        $event = new Event($request->except('thumbnail_image'));

        
            if ($request->hasFile('thumbnail_image')) {
                $path = $request->file('thumbnail_image')->store('events', 'public'); 
                $event->thumbnail_image = $path; 
            }

        $event->user_id = Auth::id();


        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show the form to edit an existing event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'maps' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft',
        ]);

        $event = Event::findOrFail($id);
        $event->fill($request->except('thumbnail_image'));

    if ($request->hasFile('thumbnail_image')) {
        if ($event->thumbnail_image) {
            Storage::disk('public')->delete($event->thumbnail_image);
        }
        
        $path = $request->file('thumbnail_image')->store('events', 'public');
        $event->thumbnail_image = $path;
    }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }


    public function destroy(Event $event)
    {
        if ($event->thumbnail_image && Storage::disk('public')->exists($event->thumbnail_image)) {
            Storage::disk('public')->delete($event->thumbnail_image);
        }
    
        $event->delete();
    
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    
    public function showDetail($id)
    {
        // $event = Event::findOrFail($id);
        
        $contacts = Contact::with('event')->where('event_id', $id)->get();

        $events = Event::with(['category', 'user'])->get();

        $qrData = '';
        foreach ($events as $event) {
            $qrData .= "Event Name: " . $event->name . "\n";
            $qrData .= "Date: " . $event->date . "\n";
            $qrData .= "-----------------------------\n"; 
        }
        
        // Generate the QR code with UTF-8 encoding
        $qrCode = QrCode::encoding('UTF-8')->size(100)->generate($qrData);
        
        $event = Event::with(['category', 'user'])->where('id', $id)->first();

        return view('admin.events.event', compact('event', 'contacts','qrCode'));

    }



    // apis 




    public function apiIndex()
    {
        $events = Event::with(['category', 'user'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Get single event (API)
     */
    public function apiShow(Event $event)
    {
        return response()->json([
            'success' => true,
            'data' => $event->load(['category', 'user'])
        ]);
    }

    /**
     * Get event contacts (API)
     */
    public function apiEventContacts($eventId)
    {
        $contacts = Contact::with('event')->where('event_id', $eventId)->get();
        
        return response()->json([
            'success' => true,
            'data' => [
                'event' => Event::find($eventId),
                'contacts' => $contacts
            ]
        ]);
    }

    /**
     * Create event (API)
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'maps' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft',
            'lat' => 'nullable',
            'long' => 'nullable',
            'type' => 'nullable',
        ]);

        $event = new Event($request->except('thumbnail_image'));

        if ($request->hasFile('thumbnail_image')) {
            $path = $request->file('thumbnail_image')->store('events', 'public'); 
            $event->thumbnail_image = $path; 
        }

        $event->user_id = 3;
        $event->save();

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event created successfully.'
        ], 201);
    }

    /**
     * Update event (API)
     */
    public function apiUpdate(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required',
            'location' => 'sometimes|required',
            'maps' => 'nullable',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'sometimes|required|in:published,draft',
            'lat' => 'nullable',
            'long' => 'nullable',
            'type' => 'nullable',
        ]);

        $event->fill($request->except('thumbnail_image'));

        if ($request->hasFile('thumbnail_image')) {
            if ($event->thumbnail_image) {
                Storage::disk('public')->delete($event->thumbnail_image);
            }
            
            $path = $request->file('thumbnail_image')->store('events', 'public');
            $event->thumbnail_image = $path;
        }

        $event->save();

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event updated successfully.'
        ]);
    }

    /**
     * Delete event (API)
     */
    public function apiDestroy(Event $event)
    {
        if ($event->thumbnail_image && Storage::disk('public')->exists($event->thumbnail_image)) {
            Storage::disk('public')->delete($event->thumbnail_image);
        }
    
        $event->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.'
        ]);
    }

    /**
     * Import contacts (API)
     */
    public function apiImportContacts(Request $request, $eventId)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new ContactsImport($eventId), $request->file('file'));
            
            return response()->json([
                'success' => true,
                'message' => 'Contacts imported successfully.',
                'count' => Contact::where('event_id', $eventId)->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error importing contacts: ' . $e->getMessage()
            ], 500);
        }
    }
    
    
    
    public function apiMarkAsDraft(Event $event)
    {
        $event->status = 'draft';
        $event->save();
    
        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event marked as draft successfully'
        ]);
    }
    
    public function apiMarkAsPublished(Event $event)
    {
        $event->status = 'published';
        $event->save();
    
        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event marked as draft successfully'
        ]);
    }


}
