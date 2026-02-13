@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Add New Coupon</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.coupon.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Coupon Code *</label>
                <input type="text" name="code" class="form-control" placeholder="SAVE10" required>
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Coupon Name</label>
                <input type="text" name="name" class="form-control" placeholder="Summer Sale Offer">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Discount Type *</label>
                <select name="discount_type" class="form-control" required>
                    <option value="flat">Flat</option>
                    <option value="percentage">Percentage</option>
                </select>
                @error('discount_type') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Discount Value *</label>
                <input type="number" step="0.01" name="discount_value" class="form-control" placeholder="e.g., 100 or 10%" required>
                @error('discount_value') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Minimum Cart Value</label>
                <input type="number" step="0.01" name="min_cart_value" class="form-control">
                @error('min_cart_value') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Maximum Discount</label>
                <input type="number" step="0.01" name="max_discount" class="form-control">
                @error('max_discount') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Total Usage Limit</label>
                <input type="number" name="usage_limit" class="form-control" placeholder="e.g., 100">
                @error('usage_limit') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Per User Usage Limit</label>
                <input type="number" name="per_user_limit" class="form-control" placeholder="e.g., 1, 2, 5">
                @error('per_user_limit') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valid From *</label>
                <input type="date" name="valid_from" class="form-control" required>
                @error('valid_from') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valid To *</label>
                <input type="date" name="valid_to" class="form-control" required>
                @error('valid_to') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Coupon</button>
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">Cancel</a>

        </form>

    </div>
</div>

@endsection