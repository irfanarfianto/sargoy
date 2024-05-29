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
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_name' => 'required|string|max:255|unique:categories,category_name',
                'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'meta_keyword' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['images'] = 'images/' . $imageName;
            }

            Category::create($validatedData);
            toastr()->success('Kategori berhasil ditambahkan!');
            return redirect()->route('categories.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan, silakan coba lagi nanti.');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id,
                'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'meta_keyword' => 'nullable|string|max:255',
            ]);

            $category = Category::findOrFail($id);

            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['images'] = 'images/' . $imageName;

                if ($category->images && file_exists(public_path($category->images))) {
                    unlink(public_path($category->images));
                }
            }

            $category->update($validatedData);
            toastr()->success('Kategori berhasil diperbarui!');
            return redirect()->route('categories.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput()->with('edit_category_id', $id);
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan, silakan coba lagi nanti.');
            return redirect()->back()->withInput();
        }
    }

    public function updatePosition(Request $request)
    {
        try {
            // Validasi data posisi kategori yang diterima dari permintaan
            $request->validate([
                'positions' => 'required|array',
                'positions.*' => 'integer|exists:categories,id',
            ]);

            // Perbarui posisi kategori berdasarkan data yang diterima
            foreach ($request->positions as $position => $categoryId) {
                $category = Category::findOrFail($categoryId);
                $category->update(['position' => $position + 1]);
            }

            toastr()->success('Kategori berhasil diperbarui!');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            toastr()->error('Terjadi kesalahan saat memperbarui posisi kategori.');
            return redirect()->route('categories.index');
            
        }
    }


    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            if ($category->images && file_exists(public_path($category->images))) {
                unlink(public_path($category->images));
            }

            $category->delete();

            toastr()->success('Kategori berhasil dihapus!');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan, silakan coba lagi nanti.');
            return redirect()->route('categories.index');
        }
    }
}
