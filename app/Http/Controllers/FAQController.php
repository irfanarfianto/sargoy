<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::all();
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        FAQ::create($request->validate([
            'pertanyaan' => 'required|min:10|string|unique:faqs',
            'jawaban' => 'required|min:10|string',
        ]));

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(FAQ $faq)
    {
        return view('faqs.show', compact('faq'));
    }

    public function edit(FAQ $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $faq->update($request->validate([
            'pertanyaan' => 'required|min:10|string|unique:faqs',
            'jawaban' => 'required|min:10|string',
        ]));

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
