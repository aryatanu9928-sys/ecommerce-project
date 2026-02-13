<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $sliders = Slider::where('status', 1)->get();
        $categories = Category::all();

        $wishlist = auth()->check()
            ? auth()->user()->wishlist->pluck('product_id')->toArray()
            : [];

        return view('frontend.home', compact('products', 'sliders', 'categories', 'wishlist'));
    }
}
