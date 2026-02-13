<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use App\Models\Coupon;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $buyNowItem = session('buy_now_item');

        if ($buyNowItem && isset($buyNowItem['price']) && isset($buyNowItem['quantity'])) {
            $totalPrice = $buyNowItem['price'] * $buyNowItem['quantity'];
        } else {
            $buyNowItem = null;
            $totalPrice = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        }

        return view('frontend.checkout', compact('cartItems', 'buyNowItem', 'totalPrice'));
    }


    public function buyNow(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $buyNowItem = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'quantity'   => $request->quantity ?? 1,
            'color'      => $request->color ?? null,
            'size'       => $request->size ?? null,
        ];

        session(['buy_now_item' => $buyNowItem]);

        return redirect()->route('checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $userId = Auth::id();

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discountAmount = 0;
        $couponCode = null;

        if (session()->has('coupon')) {
            $coupon = session('coupon');
            $couponCode = $coupon['code'];

            if ($coupon['type'] == 'flat') {
                $discountAmount = $coupon['discount'];
            } else {
                $discountAmount = ($subtotal * $coupon['discount']) / 100;
            }
        }

        $total = max(0, $subtotal - $discountAmount);


        $order = Order::create([
            'user_id'        => $userId,
            'name'           => $request->first_name . ' ' . $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'zip'            => $request->zip_code,
            'country'        => $request->country,

            'subtotal'       => $subtotal,
            'discount'       => $discountAmount,
            'total'          => $total,
            'total_price'    => $total,

            'coupon_code'    => $couponCode ?? null,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
        ]);



        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'price'      => $item->product->price,
                'quantity'   => $item->quantity,
            ]);
        }


        Cart::where('user_id', $userId)->delete();
        session()->forget('coupon');


        return redirect()->route('home')
            ->with('success', 'Order placed successfully!');
    }



    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->first();


        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code');
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->discount_value,
            'type' => $coupon->discount_type
        ]);

        return back()->with('success', 'Coupon applied successfully');
    }




    public function orders()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }

    public function viewOrder($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orders.view', compact('order'));
    }

    public function orderPdf($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        $pdf = PDF::loadView('admin.orders.pdf', compact('order'));
        return $pdf->download('order_' . $order->id . '.pdf');
    }


    public function myOrders()
    {
        $userId = Auth::id();

        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('profile.orders', compact('orders'));
    }
}
