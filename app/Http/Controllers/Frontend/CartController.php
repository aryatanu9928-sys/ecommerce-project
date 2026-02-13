<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $userId = auth()->id();

        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $id,
                'quantity'   => 1
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'color'      => 'nullable|string',
            'size'       => 'nullable|string',
        ]);

        $userId = auth()->id();

        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'color'      => $request->color,
                'size'       => $request->size,
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart');
    }


    // Add to wishlist
    public function addToWishlist($id)
    {
        Wishlist::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $id
            ]
        );

        return back()->with('success', 'Product added to wishlist');
    }

    public function cartPage()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.cart', compact('cartItems'));
    }

    public function wishlistPage()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.wishlist', compact('wishlistItems'));
    }



    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['success' => true]);
    }


    public function remove($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
