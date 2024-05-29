<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $slug = Str::slug($request->product_name . '-' . now()->format('d-m-Y-H-i-s'), '-');

        // Create product with unique slug
        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'slug' => $slug
        ]);

        // Save product images if present
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Attach categories to the product
        $product->categories()->attach($request->input('categories'));

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product.show', compact('product'));
        // return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product.edit', compact('product', 'categories'));
        // return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $product->update($request->only(['product_name', 'description', 'price']));

        if ($request->hasFile('images')) {
            $product->images()->delete();

            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        $product->categories()->detach();
        foreach ($request->input('categories') as $categoryId) {
            $product->categories()->attach($categoryId, ['product_id' => $product->id]);
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();
        $product->images()->delete();
        $product->categories()->detach();
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product Delete successfully.');
        // return response()->json($product, 200);
    }
}
