<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Herosection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = Herosection::all();
        return view('admin.LandingPage.hero-sections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.LandingPage.hero-sections.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image1')) {
            $validatedData['image1'] = $request->file('image1')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image2')) {
            $validatedData['image2'] = $request->file('image2')->store('hero-sections', 'public');
        }

        Herosection::create($validatedData);

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section created successfully.');
    }

    public function show(Herosection $heroSection)
    {
        return view('admin.LandingPage.hero-sections.show', compact('heroSection'));
    }

    public function edit(Herosection $heroSection)
    {
        return view('admin.LandingPage.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, Herosection $heroSection)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            if ($heroSection->main_image && Storage::disk('public')->exists($heroSection->main_image)) {
                Storage::disk('public')->delete($heroSection->main_image);
            }
            $validatedData['main_image'] = $request->file('main_image')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image1')) {
            if ($heroSection->image1 && Storage::disk('public')->exists($heroSection->image1)) {
                Storage::disk('public')->delete($heroSection->image1);
            }
            $validatedData['image1'] = $request->file('image1')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($heroSection->image2 && Storage::disk('public')->exists($heroSection->image2)) {
                Storage::disk('public')->delete($heroSection->image2);
            }
            $validatedData['image2'] = $request->file('image2')->store('hero-sections', 'public');
        }

        $heroSection->update($validatedData);

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section updated successfully.');
    }

    public function destroy(Herosection $heroSection)
    {
        if ($heroSection->main_image && Storage::disk('public')->exists($heroSection->main_image)) {
            Storage::disk('public')->delete($heroSection->main_image);
        }
        if ($heroSection->image1 && Storage::disk('public')->exists($heroSection->image1)) {
            Storage::disk('public')->delete($heroSection->image1);
        }
        if ($heroSection->image2 && Storage::disk('public')->exists($heroSection->image2)) {
            Storage::disk('public')->delete($heroSection->image2);
        }

        $heroSection->delete();

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $heroSections = Herosection::all();
        return response()->json([
            'success' => true,
            'data' => $heroSections
        ]);
    }

    public function apiShow(Herosection $heroSection)
    {
        return response()->json([
            'success' => true,
            'data' => $heroSection
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image1')) {
            $validatedData['image1'] = $request->file('image1')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image2')) {
            $validatedData['image2'] = $request->file('image2')->store('hero-sections', 'public');
        }

        $heroSection = Herosection::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $heroSection,
            'message' => 'Hero Section created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, Herosection $heroSection)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            if ($heroSection->main_image && Storage::disk('public')->exists($heroSection->main_image)) {
                Storage::disk('public')->delete($heroSection->main_image);
            }
            $validatedData['main_image'] = $request->file('main_image')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image1')) {
            if ($heroSection->image1 && Storage::disk('public')->exists($heroSection->image1)) {
                Storage::disk('public')->delete($heroSection->image1);
            }
            $validatedData['image1'] = $request->file('image1')->store('hero-sections', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($heroSection->image2 && Storage::disk('public')->exists($heroSection->image2)) {
                Storage::disk('public')->delete($heroSection->image2);
            }
            $validatedData['image2'] = $request->file('image2')->store('hero-sections', 'public');
        }

        $heroSection->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $heroSection,
            'message' => 'Hero Section updated successfully.'
        ]);
    }

    public function apiDestroy(Herosection $heroSection)
    {
        if ($heroSection->main_image && Storage::disk('public')->exists($heroSection->main_image)) {
            Storage::disk('public')->delete($heroSection->main_image);
        }
        if ($heroSection->image1 && Storage::disk('public')->exists($heroSection->image1)) {
            Storage::disk('public')->delete($heroSection->image1);
        }
        if ($heroSection->image2 && Storage::disk('public')->exists($heroSection->image2)) {
            Storage::disk('public')->delete($heroSection->image2);
        }

        $heroSection->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hero Section deleted successfully.'
        ]);
    }
}