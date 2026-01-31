<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index()
    {
        $informationSections = Information::all();
        return view('admin.LandingPage.information-sections.index', compact('informationSections'));
    }

    public function create()
    {
        return view('admin.LandingPage.information-sections.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title1' => 'nullable|string|max:255',
            'icon2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title2' => 'nullable|string|max:255',
            'icon3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title3' => 'nullable|string|max:255',
            'icon4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title4' => 'nullable|string|max:255',
            'image_app1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_app2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('information-sections', 'public');
        }
        
        
       if ($request->hasFile('icon1')) {
            $validatedData['icon1'] = $request->file('icon1')->store('information-sections', 'public');
        }
       if ($request->hasFile('icon2')) {
            $validatedData['icon2'] = $request->file('icon2')->store('information-sections', 'public');
        }
        if ($request->hasFile('icon3')) {
            $validatedData['icon3'] = $request->file('icon3')->store('information-sections', 'public');
        }
      if ($request->hasFile('icon4')) {
            $validatedData['icon4'] = $request->file('icon4')->store('information-sections', 'public');
        }
        
        
        if ($request->hasFile('image_app1')) {
            $validatedData['image_app1'] = $request->file('image_app1')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app2')) {
            $validatedData['image_app2'] = $request->file('image_app2')->store('information-sections', 'public');
        }
        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('information-sections', 'public');
        }

        Information::create($validatedData);

        return redirect()->route('information-sections.index')->with('success', 'Information Section created successfully.');
    }

    public function show(Information $information)
    {
        return view('admin.LandingPage.information-sections.show', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('admin.LandingPage.information-sections.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon1' => 'nullable|string|max:255',
            'title1' => 'nullable|string|max:255',
            'icon2' => 'nullable|string|max:255',
            'title2' => 'nullable|string|max:255',
            'icon3' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'icon4' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'image_app1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_app2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($information->logo && Storage::disk('public')->exists($information->logo)) {
                Storage::disk('public')->delete($information->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app1')) {
            if ($information->image_app1 && Storage::disk('public')->exists($information->image_app1)) {
                Storage::disk('public')->delete($information->image_app1);
            }
            $validatedData['image_app1'] = $request->file('image_app1')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app2')) {
            if ($information->image_app2 && Storage::disk('public')->exists($information->image_app2)) {
                Storage::disk('public')->delete($information->image_app2);
            }
            $validatedData['image_app2'] = $request->file('image_app2')->store('information-sections', 'public');
        }
        if ($request->hasFile('main_image')) {
            if ($information->main_image && Storage::disk('public')->exists($information->main_image)) {
                Storage::disk('public')->delete($information->main_image);
            }
            $validatedData['main_image'] = $request->file('main_image')->store('information-sections', 'public');
        }

        $information->update($validatedData);

        return redirect()->route('information-sections.index')->with('success', 'Information Section updated successfully.');
    }

    public function destroy(Information $information)
    {
        if ($information->logo && Storage::disk('public')->exists($information->logo)) {
            Storage::disk('public')->delete($information->logo);
        }
        if ($information->image_app1 && Storage::disk('public')->exists($information->image_app1)) {
            Storage::disk('public')->delete($information->image_app1);
        }
        if ($information->image_app2 && Storage::disk('public')->exists($information->image_app2)) {
            Storage::disk('public')->delete($information->image_app2);
        }
        if ($information->main_image && Storage::disk('public')->exists($information->main_image)) {
            Storage::disk('public')->delete($information->main_image);
        }

        $information->delete();

        return redirect()->route('information-sections.index')->with('success', 'Information Section deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $informationSections = Information::all();
        return response()->json([
            'success' => true,
            'data' => $informationSections
        ]);
    }

    public function apiShow(Information $information)
    {
        return response()->json([
            'success' => true,
            'data' => $information
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon1' => 'nullable|string|max:255',
            'title1' => 'nullable|string|max:255',
            'icon2' => 'nullable|string|max:255',
            'title2' => 'nullable|string|max:255',
            'icon3' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'icon4' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'image_app1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_app2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app1')) {
            $validatedData['image_app1'] = $request->file('image_app1')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app2')) {
            $validatedData['image_app2'] = $request->file('image_app2')->store('information-sections', 'public');
        }
        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('information-sections', 'public');
        }

        $information = Information::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $information,
            'message' => 'Information Section created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, Information $information)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'icon1' => 'nullable|string|max:255',
            'title1' => 'nullable|string|max:255',
            'icon2' => 'nullable|string|max:255',
            'title2' => 'nullable|string|max:255',
            'icon3' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'icon4' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'image_app1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_app2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($information->logo && Storage::disk('public')->exists($information->logo)) {
                Storage::disk('public')->delete($information->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app1')) {
            if ($information->image_app1 && Storage::disk('public')->exists($information->image_app1)) {
                Storage::disk('public')->delete($information->image_app1);
            }
            $validatedData['image_app1'] = $request->file('image_app1')->store('information-sections', 'public');
        }
        if ($request->hasFile('image_app2')) {
            if ($information->image_app2 && Storage::disk('public')->exists($information->image_app2)) {
                Storage::disk('public')->delete($information->image_app2);
            }
            $validatedData['image_app2'] = $request->file('image_app2')->store('information-sections', 'public');
        }
        if ($request->hasFile('main_image')) {
            if ($information->main_image && Storage::disk('public')->exists($information->main_image)) {
                Storage::disk('public')->delete($information->main_image);
            }
            $validatedData['main_image'] = $request->file('main_image')->store('information-sections', 'public');
        }

        $information->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $information,
            'message' => 'Information Section updated successfully.'
        ]);
    }

    public function apiDestroy(Information $information)
    {
        if ($information->logo && Storage::disk('public')->exists($information->logo)) {
            Storage::disk('public')->delete($information->logo);
        }
        if ($information->image_app1 && Storage::disk('public')->exists($information->image_app1)) {
            Storage::disk('public')->delete($information->image_app1);
        }
        if ($information->image_app2 && Storage::disk('public')->exists($information->image_app2)) {
            Storage::disk('public')->delete($information->image_app2);
        }
        if ($information->main_image && Storage::disk('public')->exists($information->main_image)) {
            Storage::disk('public')->delete($information->main_image);
        }

        $information->delete();

        return response()->json([
            'success' => true,
            'message' => 'Information Section deleted successfully.'
        ]);
    }
}