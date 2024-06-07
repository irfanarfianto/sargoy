<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_keyword' => 'nullable|string',
        ]);

        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['category_name']);

            // Ensure generated slug is unique
            $validatedData['slug'] = $this->generateUniqueSlug($validatedData['slug']);
        }

        if ($request->hasFile('images')) {
            $validatedData['images'] = $request->file('images')->store('categories', 'public');
        }

        Category::create($validatedData);

        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_keyword' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);

        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['category_name']);

            // Ensure generated slug is unique
            $validatedData['slug'] = $this->generateUniqueSlug($validatedData['slug'], $id);
        }

        if ($request->hasFile('images')) {
            $validatedData['images'] = $request->file('images')->store('categories', 'public');
        }

        $category->update($validatedData);

        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Helper function to generate unique slug
    private function generateUniqueSlug($slug, $id = null)
    {
        $newSlug = $slug;
        $counter = 1;

        while (Category::where('slug', $newSlug)->where('id', '!=', $id)->exists()) {
            $newSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $newSlug;
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
