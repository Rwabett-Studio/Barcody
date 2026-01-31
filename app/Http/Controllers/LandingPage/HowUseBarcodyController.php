<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\HowUseBarcody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HowUseBarcodyController extends Controller
{
    public function index()
    {
        $howUseBarcodies = HowUseBarcody::all();
        return view('admin.LandingPage.how-use-barcodies.index', compact('howUseBarcodies'));
    }

    public function create()
    {
        return view('admin.LandingPage.how-use-barcodies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('how-use-barcodies', 'public');
        }

        HowUseBarcody::create($validatedData);

        return redirect()->route('how-use-barcodies.index')->with('success', 'How To Use Barcody created successfully.');
    }

    public function show(HowUseBarcody $howUseBarcody)
    {
        return view('admin.LandingPage.how-use-barcodies.show', compact('howUseBarcody'));
    }

    public function edit(HowUseBarcody $howUseBarcody)
    {
        return view('admin.LandingPage.how-use-barcodies.edit', compact('howUseBarcody'));
    }

    public function update(Request $request, HowUseBarcody $howUseBarcody)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($howUseBarcody->image && Storage::disk('public')->exists($howUseBarcody->image)) {
                Storage::disk('public')->delete($howUseBarcody->image);
            }
            $validatedData['image'] = $request->file('image')->store('how-use-barcodies', 'public');
        }

        $howUseBarcody->update($validatedData);

        return redirect()->route('how-use-barcodies.index')->with('success', 'How To Use Barcody updated successfully.');
    }

    public function destroy(HowUseBarcody $howUseBarcody)
    {
        if ($howUseBarcody->image && Storage::disk('public')->exists($howUseBarcody->image)) {
            Storage::disk('public')->delete($howUseBarcody->image);
        }

        $howUseBarcody->delete();

        return redirect()->route('how-use-barcodies.index')->with('success', 'How To Use Barcody deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $howUseBarcodies = HowUseBarcody::all();
        return response()->json([
            'success' => true,
            'data' => $howUseBarcodies
        ]);
    }

    public function apiShow(HowUseBarcody $howUseBarcody)
    {
        return response()->json([
            'success' => true,
            'data' => $howUseBarcody
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('how-use-barcodies', 'public');
        }

        $howUseBarcody = HowUseBarcody::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $howUseBarcody,
            'message' => 'How To Use Barcody created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, HowUseBarcody $howUseBarcody)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($howUseBarcody->image && Storage::disk('public')->exists($howUseBarcody->image)) {
                Storage::disk('public')->delete($howUseBarcody->image);
            }
            $validatedData['image'] = $request->file('image')->store('how-use-barcodies', 'public');
        }

        $howUseBarcody->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $howUseBarcody,
            'message' => 'How To Use Barcody updated successfully.'
        ]);
    }

    public function apiDestroy(HowUseBarcody $howUseBarcody)
    {
        if ($howUseBarcody->image && Storage::disk('public')->exists($howUseBarcody->image)) {
            Storage::disk('public')->delete($howUseBarcody->image);
        }

        $howUseBarcody->delete();

        return response()->json([
            'success' => true,
            'message' => 'How To Use Barcody deleted successfully.'
        ]);
    }
}