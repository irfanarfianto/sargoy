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
        $breadcrumbItems = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Katalog', 'url' => route('dashboard.product.index')],
            ['name' => 'Kategori'],
        ];
        return view('dashboard.categories.index', compact('categories', 'breadcrumbItems'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        try {
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

            flash()->success('Kategori berhasil ditambahkan!');

            return redirect()->route('dashboard.categories.index');
        } catch (\Exception $e) {
            flash()->error()('Gagal menambahkan kategori: ' . $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
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

            flash()->success('Kategori berhasil diperbarui!');

            return redirect()->route('dashboard.categories.index');
        } catch (\Exception $e) {
            flash()->error('Gagal memperbarui kategori: ' . $e->getMessage());

            return redirect()->back()->withInput();
        }
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
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            flash()->success('Kategori berhasil dihapus!');

            return redirect()->route('dashboard.categories.index');
        } catch (\Exception $e) {
            flash()->error('Gagal menghapus kategori: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
