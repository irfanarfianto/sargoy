<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        try {
            FAQ::create($request->validate([
                'pertanyaan' => 'required|min:10|string|unique:faqs',
                'jawaban' => 'required|min:10|string',
            ]));

            flash()->success('FAQ berhasil dibuat.');

            return redirect()->route('faqs.index');
        } catch (\Exception $e) {
            flash()->error('Gagal membuat FAQ: ' . $e->getMessage());

            return Redirect::back()->withInput();
        }
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
        try {
            $faq->update($request->validate([
                'pertanyaan' => 'required|min:10|string|unique:faqs',
                'jawaban' => 'required|min:10|string',
            ]));

            flash()->success('FAQ berhasil diperbarui.');

            return redirect()->route('faqs.index');
        } catch (\Exception $e) {
            flash()->error('Gagal memperbarui FAQ: ' . $e->getMessage());

            return Redirect::back()->withInput();
        }
    }

    public function destroy(FAQ $faq)
    {
        try {
            $faq->delete();

            flash()->success('FAQ berhasil dihapus.');

            return redirect()->route('faqs.index');
        } catch (\Exception $e) {
            flash()->error('Gagal menghapus FAQ: ' . $e->getMessage());

            return Redirect::back();
        }
    }
}
