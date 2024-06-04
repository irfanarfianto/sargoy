<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = cache()->remember('home_page_products', 60, function () {
            return Product::latest()->get();
        });

        return view(
            'home',
            compact('products')
        );
    }
}
