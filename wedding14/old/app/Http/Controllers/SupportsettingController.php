<?php

namespace App\Http\Controllers;

use App\Models\Supportsetting;
use Illuminate\Http\Request;

class SupportsettingController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $supportsettings = Supportsetting::all();
        return view('admin.supportsettings.index', compact('supportsettings'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.supportsettings.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'dribbble' => 'nullable|string|max:255',
            'behance' => 'nullable|string|max:255',
        ]);

        Supportsetting::create($request->all());

        return redirect()->route('supportsettings.index')
                         ->with('success', 'Support setting created successfully.');
    }

    // Display the specified resource
    public function show(Supportsetting $supportsetting)
    {
        return view('admin.supportsettings.show', compact('supportsetting'));
    }

    // Show the form for editing the specified resource
    public function edit(Supportsetting $supportsetting)
    {
        return view('admin.supportsettings.edit', compact('supportsetting'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Supportsetting $supportsetting)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'dribbble' => 'nullable|string|max:255',
            'behance' => 'nullable|string|max:255',
        ]);

        $supportsetting->update($request->all());

        return redirect()->route('supportsettings.index')
                         ->with('success', 'Support setting updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Supportsetting $supportsetting)
    {
        $supportsetting->delete();

        return redirect()->route('supportsettings.index')
                         ->with('success', 'Support setting deleted successfully.');
    }
}