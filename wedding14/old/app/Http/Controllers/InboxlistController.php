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
}