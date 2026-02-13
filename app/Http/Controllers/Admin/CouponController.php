<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    // Show all coupons
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    // Show create form
    public function create()
    {
        return view('admin.coupon.create');
    }

    // Store coupon
    public function store(Request $request)
    {
        $request->validate([
            'code'           => 'required|string|max:50|unique:coupons,code',
            'name'           => 'nullable|string|max:255',
            'discount_type'  => 'required|in:flat,percentage',
            'discount_value' => 'required|numeric|min:0',
            'min_cart_value' => 'nullable|numeric|min:0',
            'max_discount'   => 'nullable|numeric|min:0',
            'usage_limit'    => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'valid_from'     => 'required|date',
            'valid_to'       => 'required|date|after_or_equal:valid_from',
            'status'         => 'required|in:0,1',
        ]);

        Coupon::create([
            'code'           => $request->code,
            'name'           => $request->name,
            'discount_type'  => $request->discount_type,
            'discount_value' => $request->discount_value,
            'min_cart_value' => $request->min_cart_value,
            'max_discount'   => $request->max_discount,
            'usage_limit'    => $request->usage_limit,
            'per_user_limit' => $request->per_user_limit,
            'valid_from'     => $request->valid_from,
            'valid_to'       => $request->valid_to,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.coupon.index')
            ->with('success', 'Coupon created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    // Update coupon
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code'           => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'name'           => 'nullable|string|max:255',
            'discount_type'  => 'required|in:flat,percentage',
            'discount_value' => 'required|numeric|min:0',
            'min_cart_value' => 'nullable|numeric|min:0',
            'max_discount'   => 'nullable|numeric|min:0',
            'usage_limit'    => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'valid_from'     => 'required|date',
            'valid_to'       => 'required|date|after_or_equal:valid_from',
            'status'         => 'required|in:0,1',
        ]);

        $coupon->update([
            'code'           => $request->code,
            'name'           => $request->name,
            'discount_type'  => $request->discount_type,
            'discount_value' => $request->discount_value,
            'min_cart_value' => $request->min_cart_value,
            'max_discount'   => $request->max_discount,
            'usage_limit'    => $request->usage_limit,
            'per_user_limit' => $request->per_user_limit,
            'valid_from'     => $request->valid_from,
            'valid_to'       => $request->valid_to,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.coupon.index')
            ->with('success', 'Coupon updated successfully!');
    }

    // Delete coupon
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupon.index')
            ->with('success', 'Coupon deleted successfully!');
    }
}
