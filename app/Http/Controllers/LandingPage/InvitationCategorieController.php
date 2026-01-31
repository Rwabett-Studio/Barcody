<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\InvitationCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvitationCategorieController extends Controller
{
    public function index()
    {
        $invitationCategories = InvitationCategorie::all();
        return view('admin.LandingPage.invitation-categories.index', compact('invitationCategories'));
    }

    public function create()
    {
        return view('admin.LandingPage.invitation-categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('invitation-categories', 'public');
        }

        InvitationCategorie::create($validatedData);

        return redirect()->route('invitation-categories.index')->with('success', 'Invitation Category created successfully.');
    }

    public function show(InvitationCategorie $invitationCategorie)
    {
        return view('admin.LandingPage.invitation-categories.show', compact('invitationCategorie'));
    }

    public function edit(InvitationCategorie $invitationCategorie)
    {
        return view('admin.LandingPage.invitation-categories.edit', compact('invitationCategorie'));
    }

    public function update(Request $request, InvitationCategorie $invitationCategorie)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($invitationCategorie->image && Storage::disk('public')->exists($invitationCategorie->image)) {
                Storage::disk('public')->delete($invitationCategorie->image);
            }
            $validatedData['image'] = $request->file('image')->store('invitation-categories', 'public');
        }

        $invitationCategorie->update($validatedData);

        return redirect()->route('invitation-categories.index')->with('success', 'Invitation Category updated successfully.');
    }

    public function destroy(InvitationCategorie $invitationCategorie)
    {
        if ($invitationCategorie->image && Storage::disk('public')->exists($invitationCategorie->image)) {
            Storage::disk('public')->delete($invitationCategorie->image);
        }

        $invitationCategorie->delete();

        return redirect()->route('invitation-categories.index')->with('success', 'Invitation Category deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $invitationCategories = InvitationCategorie::all();
        return response()->json([
            'success' => true,
            'data' => $invitationCategories
        ]);
    }

    public function apiShow(InvitationCategorie $invitationCategorie)
    {
        return response()->json([
            'success' => true,
            'data' => $invitationCategorie
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('invitation-categories', 'public');
        }

        $invitationCategorie = InvitationCategorie::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $invitationCategorie,
            'message' => 'Invitation Category created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, InvitationCategorie $invitationCategorie)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'sometimes|required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($invitationCategorie->image && Storage::disk('public')->exists($invitationCategorie->image)) {
                Storage::disk('public')->delete($invitationCategorie->image);
            }
            $validatedData['image'] = $request->file('image')->store('invitation-categories', 'public');
        }

        $invitationCategorie->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $invitationCategorie,
            'message' => 'Invitation Category updated successfully.'
        ]);
    }

    public function apiDestroy(InvitationCategorie $invitationCategorie)
    {
        if ($invitationCategorie->image && Storage::disk('public')->exists($invitationCategorie->image)) {
            Storage::disk('public')->delete($invitationCategorie->image);
        }

        $invitationCategorie->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invitation Category deleted successfully.'
        ]);
    }
}