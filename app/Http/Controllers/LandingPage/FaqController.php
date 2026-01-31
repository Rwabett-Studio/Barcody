<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.LandingPage.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.LandingPage.faqs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($validatedData);

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(Faq $faq)
    {
        return view('admin.LandingPage.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.LandingPage.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($validatedData);

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $faqs = Faq::all();
        return response()->json([
            'success' => true,
            'data' => $faqs
        ]);
    }

    public function apiShow(Faq $faq)
    {
        return response()->json([
            'success' => true,
            'data' => $faq
        ]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $faq,
            'message' => 'FAQ created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'question' => 'sometimes|required|string|max:255',
            'answer' => 'sometimes|required|string',
        ]);

        $faq->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $faq,
            'message' => 'FAQ updated successfully.'
        ]);
    }

    public function apiDestroy(Faq $faq)
    {
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully.'
        ]);
    }
}