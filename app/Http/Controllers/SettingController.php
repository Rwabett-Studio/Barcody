<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('fav_icon')) {
            $validatedData['fav_icon'] = $request->file('fav_icon')->store('settings', 'public');
        }
        if ($request->hasFile('header_logo')) {
            $validatedData['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            $validatedData['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        Setting::create($validatedData);

        return redirect()->route('settings.index')->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('fav_icon')) {
            // Delete the old fav_icon if it exists
            if ($setting->fav_icon && Storage::disk('public')->exists($setting->fav_icon)) {
                Storage::disk('public')->delete($setting->fav_icon);
            }
            $validatedData['fav_icon'] = $request->file('fav_icon')->store('settings', 'public');
        }
        if ($request->hasFile('header_logo')) {
            // Delete the old header_logo if it exists
            if ($setting->header_logo && Storage::disk('public')->exists($setting->header_logo)) {
                Storage::disk('public')->delete($setting->header_logo);
            }
            $validatedData['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            // Delete the old footer_logo if it exists
            if ($setting->footer_logo && Storage::disk('public')->exists($setting->footer_logo)) {
                Storage::disk('public')->delete($setting->footer_logo);
            }
            $validatedData['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        $setting->update($validatedData);

        return redirect()->route('settings.index')->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Delete associated files
        if ($setting->fav_icon && Storage::disk('public')->exists($setting->fav_icon)) {
            Storage::disk('public')->delete($setting->fav_icon);
        }
        if ($setting->header_logo && Storage::disk('public')->exists($setting->header_logo)) {
            Storage::disk('public')->delete($setting->header_logo);
        }
        if ($setting->footer_logo && Storage::disk('public')->exists($setting->footer_logo)) {
            Storage::disk('public')->delete($setting->footer_logo);
        }

        $setting->delete();

        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully.');
    }





    public function apiIndex()
    {
        $settings = Setting::all();
        
        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    /**
     * Get single setting (API)
     */
    public function apiShow(Setting $setting)
    {
        return response()->json([
            'success' => true,
            'data' => $setting
        ]);
    }

    /**
     * Create setting (API)
     */
    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('fav_icon')) {
            $validatedData['fav_icon'] = $request->file('fav_icon')->store('settings', 'public');
        }
        if ($request->hasFile('header_logo')) {
            $validatedData['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            $validatedData['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        $setting = Setting::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $setting,
            'message' => 'Setting created successfully.'
        ], 201);
    }

    /**
     * Update setting (API)
     */
    public function apiUpdate(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('fav_icon')) {
            // Delete the old fav_icon if it exists
            if ($setting->fav_icon && Storage::disk('public')->exists($setting->fav_icon)) {
                Storage::disk('public')->delete($setting->fav_icon);
            }
            $validatedData['fav_icon'] = $request->file('fav_icon')->store('settings', 'public');
        }
        if ($request->hasFile('header_logo')) {
            // Delete the old header_logo if it exists
            if ($setting->header_logo && Storage::disk('public')->exists($setting->header_logo)) {
                Storage::disk('public')->delete($setting->header_logo);
            }
            $validatedData['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            // Delete the old footer_logo if it exists
            if ($setting->footer_logo && Storage::disk('public')->exists($setting->footer_logo)) {
                Storage::disk('public')->delete($setting->footer_logo);
            }
            $validatedData['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        $setting->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $setting,
            'message' => 'Setting updated successfully.'
        ]);
    }

    /**
     * Delete setting (API)
     */
    public function apiDestroy(Setting $setting)
    {
        // Delete associated files
        if ($setting->fav_icon && Storage::disk('public')->exists($setting->fav_icon)) {
            Storage::disk('public')->delete($setting->fav_icon);
        }
        if ($setting->header_logo && Storage::disk('public')->exists($setting->header_logo)) {
            Storage::disk('public')->delete($setting->header_logo);
        }
        if ($setting->footer_logo && Storage::disk('public')->exists($setting->footer_logo)) {
            Storage::disk('public')->delete($setting->footer_logo);
        }

        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Setting deleted successfully.'
        ]);
    }
}