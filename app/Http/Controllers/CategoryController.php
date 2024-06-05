<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

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
