@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Edit Coupon</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Coupon Code *</label>
                <input type="text" name="code"
                    value="{{ $coupon->code }}"
                    class="form-control" required>
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Coupon Name</label>
                <input type="text" name="name"
                    value="{{ $coupon->name }}"
                    class="form-control">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Discount Type *</label>
                <select name="discount_type" class="form-control" required>
                    <option value="flat" {{ $coupon->discount_type == 'flat' ? 'selected' : '' }}>Flat</option>
                    <option value="percentage" {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Discount Value *</label>
                <input type="number" step="0.01" name="discount_value"
                    class="form-control"
                    value="{{ $coupon->discount_value }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Minimum Cart Value</label>
                <input type="number" step="0.01" name="min_cart_value"
                    class="form-control"
                    value="{{ $coupon->min_cart_value }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Maximum Discount</label>
                <input type="number" step="0.01" name="max_discount"
                    class="form-control"
                    value="{{ $coupon->max_discount }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Total Usage Limit</label>
                <input type="number" name="usage_limit"
                    class="form-control"
                    value="{{ $coupon->usage_limit }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Per User Usage Limit</label>
                <input type="number" name="per_user_limit"
                    class="form-control"
                    value="{{ $coupon->per_user_limit }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Valid From *</label>
                <input type="date" name="valid_from"
                    value="{{ $coupon->valid_from }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Valid To *</label>
                <input type="date" name="valid_to"
                    value="{{ $coupon->valid_to }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Coupon</button>
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">Back</a>

        </form>

    </div>
</div>

@endsection