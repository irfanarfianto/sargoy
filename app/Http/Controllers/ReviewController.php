<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviewPost(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
        ]);

        $product = Product::where('id', $id)->firstOrFail();

        // $user_id = Auth::id();
        $product_id = $product->id;

        $review = new Review();
        $review->user_id = $request->user_id;
        $review->product_id = $product_id;
        $review->content = $request->content;
        $review->save();
    }
}
