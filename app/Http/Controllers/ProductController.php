<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use NumberFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with('images')->paginate(9);
        $categories = Category::all();

        foreach ($products as $product) {
            $product->price = NumberHelper::getCurrencyFormatter()->formatCurrency($product->price, 'IDR');
        }

        return view('dashboard.product.index', compact('products'));
    }

    /**
     * Display a listing of the resource for the public.
     */
    public function publicIndex()
    {
        $products = Product::with('images')->paginate(9);
        $categories = Category::all();

        foreach ($products as $product) {
            $product->price = NumberHelper::getCurrencyFormatter()->formatCurrency($product->price, 'IDR');
        }

        return view('product.index', ['products' => $products, 'categories' => $categories]);
    }

    public function show($slug)
    {
        $product = Product::with('images', 'categories')->where('slug', $slug)->firstOrFail();
        $product->price = NumberHelper::getCurrencyFormatter()->formatCurrency($product->price, 'IDR');

        $breadcrumbItems = [
            ['name' => 'Beranda', 'url' => '/'],
            ['name' => 'Produk', 'url' => route('public.product.index')],
            ['name' => $product->product_name],
        ];

        return view('product.show', compact('product', 'breadcrumbItems'));
    }


    public function create()
    {

        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
            ]);

            // Cek jumlah gambar
            if ($request->hasFile('images') && count($request->file('images')) > 4) {
                return Redirect::back()->withErrors(['images' => 'Anda hanya bisa mengunggah maksimal 4 gambar.'])->withInput();
            }

            // Format harga menggunakan NumberFormatter
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
            $price = $formatter->formatCurrency($validatedData['price'], 'IDR');

            $slug = Str::slug($request->product_name . '-' . now()->format('d-m-Y-H-i-s'), '-');

            // Ensure slug is unique
            $existingSlugs = Product::where('slug', 'like', $slug . '%')->pluck('slug');
            if ($existingSlugs->contains($slug)) {
                $count = 2;
                while ($existingSlugs->contains($slug . '-' . $count)) {
                    $count++;
                }
                $slug = $slug . '-' . $count;
            }

            // Create product with unique slug
            $product = Product::create([
                'product_name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'price' => $price,
                'slug' => $slug,
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

            flash()->success('Produk berhasil dibuat.');

            return redirect()->route('dashboard.product.index');
        } catch (\Exception $e) {
            flash()->error('Gagal membuat produk: ' . $e->getMessage());

            return Redirect::back()->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();

            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
            ]);

            // Update product with validated data
            $product->update($validatedData);

            // Ensure price is stored correctly
            $product->price = str_replace(['.', ','], '', $product->price);

            // Update product images if present
            if ($request->hasFile('images')) {
                // Delete existing images from server
                foreach ($product->images as $image) {
                    Storage::delete($image->image_path);
                    $image->delete();
                }

                // Add new images
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('product_images');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }

            // Update product categories
            $product->categories()->sync($request->input('categories'));

            flash()->success('Produk berhasil diperbarui.');

            return redirect()->route('dashboard.product.index');
        } catch (\Exception $e) {
            flash()->error('Gagal memperbarui produk: ' . $e->getMessage());

            return Redirect::back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();
            $product->images()->delete();
            $product->categories()->detach();
            $product->delete();
            flash()->success('Produk berhasil dihapus.');

            return redirect()->route('dashboard.product.index');
        } catch (\Exception $e) {
            flash()->error('Gagal menghapus produk: ' . $e->getMessage());

            return Redirect::back();
        }
    }

    /**
     * Load more products for infinite scroll.
     */
    public function loadMoreProducts(Request $request)
    {
        $offset = $request->input('offset');
        $limit = 9;

        $products = Product::skip($offset)->take($limit)->get();
        $products->transform(function ($product) {
            $product->price = number_format($product->price, 0, ',', '.');
            return $product;
        });

        return response()->json($products);
    }
}
