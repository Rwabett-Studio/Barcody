<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('event')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        $events = Event::all();
        return view('admin.contacts.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs',
            'phone' => 'required|string|unique:contacts,phone',
            'event_id' => 'required|exists:events,id',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $events = Event::all();
        return view('admin.contacts.edit', compact('contact', 'events'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs',
            'phone' => 'required|string|unique:contacts,phone,' . $id,
            'event_id' => 'required|exists:events,id',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

      return redirect()->route('event.detail', ['id' => $contact->event_id])
                    ->with('success', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function showImportForm()
    {
        $events = Event::all();
        return view('admin.contacts.import', compact('events'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'event_id' => 'required|exists:events,id',
        ]);

        Excel::import(new ContactsImport($request->event_id), $request->file('file'));

        return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully.');
    }



    // api 


    public function apiIndex()
    {
        $contacts = Contact::with('event')->get();
        
        return response()->json([
            'success' => true,
            'data' => $contacts,
            'message' => 'Contacts retrieved successfully'
        ]);
    }




    /**
     * Get single contact (API)
     */
    public function apiShow($id)
    {
        $contact = Contact::with('event')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $contact,
            'message' => 'Contact retrieved successfully'
        ]);
    }

    /**
     * Create contact (API)
     */
    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'phone' => 'required|string|unique:contacts,phone',
            'event_id' => 'required|exists:events,id',
        ]);

        $contact = Contact::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $contact->load('event'),
            'message' => 'Contact created successfully'
        ], 201);
    }

    /**
     * Update contact (API)
     */
    public function apiUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|string|in:mr,mrs',
            'phone' => 'sometimes|required|string|unique:contacts,phone,'.$id,
            'event_id' => 'sometimes|required|exists:events,id',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $contact->load('event'),
            'message' => 'Contact updated successfully'
        ]);
    }

    /**
     * Delete contact (API)
     */
    public function apiDestroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully'
        ]);
    }

    /**
     * Import contacts (API)
     */
    public function apiImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'event_id' => 'required|exists:events,id',
        ]);

        try {
            Excel::import(new ContactsImport($request->event_id), $request->file('file'));
            
            $count = Contact::where('event_id', $request->event_id)->count();
            
            return response()->json([
                'success' => true,
                'message' => 'Contacts imported successfully',
                'imported_count' => $count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error importing contacts: ' . $e->getMessage()
            ], 500);
        }
    }
    
    
public function apiInvited(Request $request)
{
    $query = Contact::where('invited', 1)->with('event');
    
    if ($request->has('event_id')) {
        $query->where('event_id', $request->event_id);
    }
    
    $contacts = $query->get();
    
    return response()->json([
        'success' => true,
        'data' => $contacts,
        'message' => 'Invited contacts retrieved successfully'
    ]);
}

// Remove any other duplicate apiInvited() method


public function apiEventInvited(Event $event)
{
    $contacts = $event->contacts()->where('invited', 1)->get();
    
    return response()->json([
        'success' => true,
        'data' => $contacts,
        'message' => 'Invited contacts for event retrieved successfully'
    ]);
}


}