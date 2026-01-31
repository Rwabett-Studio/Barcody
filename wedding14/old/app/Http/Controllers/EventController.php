<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('category')->get();

    
        $qrData = '';
        foreach ($events as $event) {
            $qrData .= "Event Name: " . $event->name . "\n";
            $qrData .= "Date: " . $event->date . "\n";
            $qrData .= "Time: " . $event->time . "\n";
            // $qrData .= "Maps: " . $event->maps . "\n";
            $qrData .= "Location: " . $event->location . "\n";
            $qrData .= "-----------------------------\n"; // Separator between events
        }
        
        // Generate the QR code with UTF-8 encoding
        $qrCode = QrCode::encoding('UTF-8')->size(100)->generate($qrData);
        
        return view('admin.events.index', compact('events', 'qrCode'));
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
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'maps' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft',
        ]);

        $event = new Event($request->except('thumbnail_image'));

        if ($request->hasFile('thumbnail_image')) {
            $path = $request->file('thumbnail_image')->store('public/events');
            $event->thumbnail_image = str_replace('public/', '', $path);
        }

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
            $path = $request->file('thumbnail_image')->store('public/events');
            $event->thumbnail_image = str_replace('public/', '', $path);
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
}
