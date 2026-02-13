<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class FrontCategoryProductController extends Controller
{

    public function products(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $headerCategories = Category::all();

        $query = Product::with('categories');

        // ✅ If user selected categories → use them ONLY
        if ($request->filled('category_ids')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->category_ids);
            });
        }
        // ✅ Otherwise → default category
        else {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            });
        }

        // ✅ Price filter
        $minPrice = $request->min_price ?? 0;
        $maxPrice = $request->max_price ?? 1000000;

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        $products = $query->get();

        return view('frontend.category.products', compact(
            'category',
            'headerCategories',
            'products'
        ));
    }




    public function show($slug)
    {
        $category = Category::with('children')->where('slug', $slug)->firstOrFail();

        return view('frontend.category.show', compact('category'));
    }
}
