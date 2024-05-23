<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'product_name' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Handle file upload
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['images'] = 'images/' . $imageName;
        }

        Product::create($validatedData);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        dd($product->product_name);
        // return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'product_name' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('images')) {
            if ($product->images && file_exists(public_path($product->images))) {
                unlink(public_path($product->images));
            }

            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['images'] = 'images/' . $imageName;
        } else {
            $validatedData['images'] = $product->images;
        }

        $product->update($validatedData);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->images && file_exists(public_path($product->images))) {
            unlink(public_path($product->images));
        }

        $product->delete();

        return redirect()->route('product.index');
    }
}
