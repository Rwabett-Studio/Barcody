<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.LandingPage.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.LandingPage.plans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'item1' => 'nullable|string|max:255',
            'item2' => 'nullable|string|max:255',
            'item3' => 'nullable|string|max:255',
            'item4' => 'nullable|string|max:255',
            'item5' => 'nullable|string|max:255',
        ]);

        Plan::create($validatedData);

        return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
    }

    public function show(Plan $plan)
    {
        return view('admin.LandingPage.plans.show', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('admin.LandingPage.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'item1' => 'nullable|string|max:255',
            'item2' => 'nullable|string|max:255',
            'item3' => 'nullable|string|max:255',
            'item4' => 'nullable|string|max:255',
            'item5' => 'nullable|string|max:255',
        ]);

        $plan->update($validatedData);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $plans = Plan::all();
        return response()->json([
            'success' => true,
            'data' => $plans
        ]);
    }

    public function apiShow(Plan $plan)
    {
        return response()->json([
            'success' => true,
            'data' => $plan
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'item1' => 'nullable|string|max:255',
            'item2' => 'nullable|string|max:255',
            'item3' => 'nullable|string|max:255',
            'item4' => 'nullable|string|max:255',
            'item5' => 'nullable|string|max:255',
        ]);

        $plan = Plan::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $plan,
            'message' => 'Plan created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, Plan $plan)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|string|max:255',
            'item1' => 'nullable|string|max:255',
            'item2' => 'nullable|string|max:255',
            'item3' => 'nullable|string|max:255',
            'item4' => 'nullable|string|max:255',
            'item5' => 'nullable|string|max:255',
        ]);

        $plan->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $plan,
            'message' => 'Plan updated successfully.'
        ]);
    }

    public function apiDestroy(Plan $plan)
    {
        $plan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plan deleted successfully.'
        ]);
    }
}