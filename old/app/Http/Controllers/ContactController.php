<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // List all contacts for the authenticated user
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::id())->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    // Show the form to create a new contact
    public function create()
    {
        return view('admin.contacts.create');
    }

    // Store a new contact
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs',
            'phone' => 'required|string|unique:contacts,phone',
        ]);

        // Automatically assign the authenticated user's ID
        $contact = new Contact($request->all());
        $contact->user_id = Auth::id(); 
        $contact->save();

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show the form to edit a contact
    public function edit(Contact $contact)
    {
        // Ensure the contact belongs to the authenticated user
        // if ($contact->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        return view('admin.contacts.edit', compact('contact'));
    }

    // Update a contact
    public function update(Request $request, Contact $contact)
    {

    
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:mr,mrs', // Ensure gender values match your form
            'phone' => 'required|string|unique:contacts,phone,' . $contact->id,
        ]);
    
        // Update the contact
        $contact->update($request->all());
    
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Delete a contact
    public function destroy(Contact $contact)
    {
        // Ensure the contact belongs to the authenticated user
        // if ($contact->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    // Show the import form
    public function showImportForm()
    {
        return view('admin.contacts.import');
    }

    // Import contacts from a file
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Import contacts and assign the authenticated user's ID
        Excel::import(new ContactsImport(Auth::id()), $request->file('file'));

        return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully.');
    }
}