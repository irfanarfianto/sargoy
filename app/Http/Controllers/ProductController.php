<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use NumberFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with('images')->paginate(9);
        $categories = Category::all();

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        foreach ($products as $product) {
            $product->price = $formatter->formatCurrency($product->price, 'IDR');
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

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        foreach ($products as $product) {
            $product->price = $formatter->formatCurrency($product->price, 'IDR');
        }

        return view('product.index', ['products' => $products, 'categories' => $categories]);
    }

    public function show($slug)
    {
        $product = Product::with('images', 'categories')->where('slug', $slug)->firstOrFail();
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $product->price = $formatter->formatCurrency($product->price, 'IDR');

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

            $validatedData['price'] = str_replace(['.', ','], '', $validatedData['price']);
            $slug = Str::slug($request->product_name . '-' . now()->format('d-m-Y-H-i-s'), '-');

            // Create product with unique slug
            $product = Product::create([
                'product_name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'price' => $validatedData['price'],
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
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
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

            $product = Product::where('slug', $slug)->firstOrFail();
            $validatedData['price'] = str_replace(['.', ','], '', $validatedData['price']);
            $product->update($validatedData);

            // Update product images if present
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
