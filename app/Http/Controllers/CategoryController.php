<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Simpan kategori ke dalam database
        \App\Models\Category::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('categories.create')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
