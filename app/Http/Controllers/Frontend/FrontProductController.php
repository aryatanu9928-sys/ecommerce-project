<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontProductController extends Controller
{
    public function index(Request $request)
    {
        // Start the query
        $query = Product::query();

        // 1. Filter by Multiple Categories
        if ($request->has('categories') && $request->categories != '') {
            $categoryList = explode(',', $request->categories);
            $query->whereIn('category_name', $categoryList);
        }

        // 2. Filter by Price Range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Get the filtered products
        $products = $query->get();

        return view('frontend.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $user = auth()->user();

        $inWishlist = false;

        if ($user) {
            $inWishlist = \App\Models\Wishlist::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('frontend.products.show', compact('product', 'inWishlist'));
    }
}
