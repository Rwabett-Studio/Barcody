<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia; // Assuming you have a SocialMedia model

class SocialMediaController extends Controller
{
    // Display all social media entries
    public function index()
    {
        $socialMedias = SocialMedia::all();
        return view('admin.SocialMedia.index', compact('socialMedias'));
    }

    // Show the form to create a new social media entry
    public function create()
    {
        return view('admin.SocialMedia.create');
    }

    // Store a new social media entry
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'youtube' => 'nullable',
            'twitter' => 'nullable',
        ]);

        SocialMedia::create($request->all());

        return redirect()->route('SocialMedia.index')->with('success', 'Social media entry created successfully.');
    }

    // Show the form to edit an existing social media entry
    public function edit($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        return view('admin.SocialMedia.edit', compact('socialMedia'));
    }

    // Update an existing social media entry
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'youtube' => 'nullable',
            'twitter' => 'nullable',
        ]);

        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->update($request->all());

        return redirect()->route('SocialMedia.index')->with('success', 'Social media entry updated successfully.');
    }

    // Delete a social media entry
    public function destroy($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();

        return redirect()->route('SocialMedia.index')->with('success', 'Social media entry deleted successfully.');
    }


   // api


    public function apiIndex()
    {
        $socialMedias = SocialMedia::all();
        
        return response()->json([
            'success' => true,
            'data' => $socialMedias
        ]);
    }

    /**
     * Get single social media entry (API)
     */
    public function apiShow($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $socialMedia
        ]);
    }

    /**
     * Create social media entry (API)
     */
    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'whatsapp' => 'nullable|string',
            'facebook' => 'nullable|string',
            'youtube' => 'nullable|string',
            'twitter' => 'nullable|string',
            // Add other platforms as needed
        ]);

        $socialMedia = SocialMedia::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $socialMedia,
            'message' => 'Social media entry created successfully.'
        ], 201);
    }

    /**
     * Update social media entry (API)
     */
    public function apiUpdate(Request $request, $id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string',
            'whatsapp' => 'nullable|string',
            'facebook' => 'nullable|string',
            'youtube' => 'nullable|string',
            'twitter' => 'nullable|string',
            // Add other platforms as needed
        ]);

        $socialMedia->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $socialMedia,
            'message' => 'Social media entry updated successfully.'
        ]);
    }

    /**
     * Delete social media entry (API)
     */
    public function apiDestroy($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Social media entry deleted successfully.'
        ]);
    }
}