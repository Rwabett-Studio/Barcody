<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        // Check if the user has the 'create_role' (value = 1)
        if (Auth::user()->create_role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Check if the user has the 'create_role' (value = 1)
        if (Auth::user()->create_role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        // if ($request->hasFile('icon')) {
        //     $iconPath = $request->file('icon')->store('icons', 'public'); 
        //     $validated['icon'] = $iconPath;
        // }

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Check if the user has the 'edit_role' (value = 1)
        if (Auth::user()->edit_role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Check if the user has the 'edit_role' (value = 1)
        if (Auth::user()->edit_role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        // if ($request->hasFile('icon')) {
        //     if ($category->icon && Storage::disk('public')->exists($category->icon)) {
        //         Storage::disk('public')->delete($category->icon);
        //     }

        //     $iconPath = $request->file('icon')->store('icons', 'public'); 
        //     $validated['icon'] = $iconPath;
        // }

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if the user has the 'delete_role' (value = 1)
        if (Auth::user()->delete_role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the icon file if it exists
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }



// api


    public function apiIndex()
    {
        $categories = Category::all();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get single category (API)
     */
    public function apiShow(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Create category (API)
     */
    public function apiStore(Request $request)
    {
        // Check create permission
        if (Auth::user()->create_role !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public'); 
            $validated['icon'] = $iconPath;
        }

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category created successfully.'
        ], 201);
    }

    /**
     * Update category (API)
     */
    public function apiUpdate(Request $request, Category $category)
    {
        // Check edit permission
        if (Auth::user()->edit_role !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('icon')) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            $iconPath = $request->file('icon')->store('icons', 'public'); 
            $validated['icon'] = $iconPath;
        }

        $category->update($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category updated successfully.'
        ]);
    }

    /**
     * Delete category (API)
     */
    public function apiDestroy(Category $category)
    {
        // Check delete permission
        if (Auth::user()->delete_role !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        // Delete the icon file if it exists
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }
}