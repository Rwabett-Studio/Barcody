<?php

namespace App\Http\Controllers;

use App\Models\Inboxlist;
use Illuminate\Http\Request;

class InboxlistController extends Controller
{
    public function index()
    {
        $inboxlists = Inboxlist::all();
        return view('admin.inboxlists.index', compact('inboxlists'));
    }

    public function create()
    {
        return view('admin.inboxlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Inboxlist::create($request->all());

        return redirect()->route('inboxlists.index')
                         ->with('success', 'Inboxlist created successfully.');
    }

    public function show(Inboxlist $inboxlist)
    {
        return view('admin.inboxlists.show', compact('inboxlist'));
    }

    public function edit(Inboxlist $inboxlist)
    {
        return view('admin.inboxlists.edit', compact('inboxlist'));
    }

    public function update(Request $request, Inboxlist $inboxlist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $inboxlist->update($request->all());

        return redirect()->route('inboxlists.index')
                         ->with('success', 'Inboxlist updated successfully.');
    }

    public function destroy(Inboxlist $inboxlist)
    {
        $inboxlist->delete();

        return redirect()->route('inboxlists.index')
                         ->with('success', 'Inboxlist deleted successfully.');
    }



    
    // api



    public function apiIndex()
    {
        $inboxlists = Inboxlist::all();
        
        return response()->json([
            'success' => true,
            'data' => $inboxlists,
            'message' => 'Inbox entries retrieved successfully.'
        ]);
    }

    /**
     * Get single inbox entry (API)
     */
    public function apiShow(Inboxlist $inboxlist)
    {
        return response()->json([
            'success' => true,
            'data' => $inboxlist,
            'message' => 'Inbox entry retrieved successfully.'
        ]);
    }

    /**
     * Create inbox entry (API)
     */
    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $inboxlist = Inboxlist::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $inboxlist,
            'message' => 'Inbox entry created successfully.'
        ], 201);
    }

    /**
     * Update inbox entry (API)
     */
    public function apiUpdate(Request $request, Inboxlist $inboxlist)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'message' => 'sometimes|required|string',
        ]);

        $inboxlist->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $inboxlist,
            'message' => 'Inbox entry updated successfully.'
        ]);
    }

    /**
     * Delete inbox entry (API)
     */
    public function apiDestroy(Inboxlist $inboxlist)
    {
        $inboxlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inbox entry deleted successfully.'
        ]);
    }
}