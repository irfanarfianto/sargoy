<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Pastikan Anda mengimpor model Category
use Illuminate\Http\Request;
use NumberFormatter;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = cache()->remember('home_page_products', 60, function () {
            return Product::latest()->with('images')->get();
        });

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
        foreach ($products as $product) {
            $product->price = $formatter->formatCurrency($product->price, 'IDR');
        }

        $categories = cache()->remember('home_page_categories', 60, function () {
            return Category::all();
        });

        return view('home.index', compact('products', 'categories'));
    }
}
