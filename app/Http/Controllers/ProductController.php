<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hasAdminRole = $user ? $user->hasRole('admin') : false;
        $hasSellerRole = $user ? $user->hasRole('seller') : false;
        $paginateCount = $hasAdminRole || $hasSellerRole ? 10 : 12;

        if ($hasAdminRole || $hasSellerRole) {
            $products = Product::paginate($paginateCount);
            $products->getCollection()->transform(function ($product) {
                $product->price = number_format($product->price, 0, ',', '.');
                return $product;
            });
            return view('dashboard.product.index', compact('products'));
        } else {
            return redirect()->route('product.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $imageName = time() . '.' . $validatedData['images']->getClientOriginalExtension();
        $validatedData['images']->move(public_path('images'), $imageName);
        $validatedData['images'] = 'images/' . $imageName;

        $validatedData['price'] = str_replace(['.', ','], '', $validatedData['price']);

        Product::create($validatedData);

        return redirect()->route('dashboard.product.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

            $imageName = time() . '.' . $validatedData['images']->getClientOriginalExtension();
            $validatedData['images']->move(public_path('images'), $imageName);
            $validatedData['images'] = 'images/' . $imageName;
        }

        $validatedData['price'] = str_replace(['.', ','], '', $validatedData['price']);

        $product->update($validatedData);

        return redirect()->route('dashboard.product.index');
    }
}

