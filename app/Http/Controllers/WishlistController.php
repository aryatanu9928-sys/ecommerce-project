<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->pluck('product');

        return view('profile.wishlist', compact('wishlistItems'));
    }

    public function store($product_id)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product_id
        ]);

        return back()->with('success', 'Added to wishlist');
    }

    public function toggle($product_id)
    {
        $userId = Auth::id();
        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $product_id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['added' => false]);
        }

        Wishlist::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $product_id,
        ]);

        return response()->json(['added' => true]);
    }



    public function remove($product_id)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->delete();

        return back()->with('success', 'Removed from wishlist');
    }
}
