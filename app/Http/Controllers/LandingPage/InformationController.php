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

        $validatedData = $this->syncUploadedImages($request, $validatedData);

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

        $validatedData = $this->syncUploadedImages($request, $validatedData, $information);

        $information->update($validatedData);

        return redirect()->route('information-sections.index')->with('success', 'Information Section updated successfully.');
    }

    public function destroy(Information $information)
    {
        $this->deleteUploadedImages($information);

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

        $validatedData = $this->syncUploadedImages($request, $validatedData);

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

        $validatedData = $this->syncUploadedImages($request, $validatedData, $information);

        $information->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $information,
            'message' => 'Information Section updated successfully.'
        ]);
    }

    public function apiDestroy(Information $information)
    {
        $this->deleteUploadedImages($information);

        $information->delete();

        return response()->json([
            'success' => true,
            'message' => 'Information Section deleted successfully.'
        ]);
    }

    private function imageFields(): array
    {
        return ['logo', 'icon1', 'icon2', 'icon3', 'icon4', 'image_app1', 'image_app2', 'main_image'];
    }

    private function syncUploadedImages(Request $request, array $validatedData, ?Information $information = null): array
    {
        foreach ($this->imageFields() as $field) {
            if (!$request->hasFile($field)) {
                continue;
            }

            if ($information && $information->{$field} && Storage::disk('public')->exists($information->{$field})) {
                Storage::disk('public')->delete($information->{$field});
            }

            $validatedData[$field] = $request->file($field)->store('information-sections', 'public');
        }

        return $validatedData;
    }

    private function deleteUploadedImages(Information $information): void
    {
        foreach ($this->imageFields() as $field) {
            if ($information->{$field} && Storage::disk('public')->exists($information->{$field})) {
                Storage::disk('public')->delete($information->{$field});
            }
        }
    }
}
