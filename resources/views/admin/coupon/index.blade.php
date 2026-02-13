@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>All Coupons</h3>
        <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">Add New Coupon</a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Discount</th>
                    <th>Min Cart</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->name ?? '-' }}</td>

                    <td>
                        @if($coupon->discount_type == 'flat')
                        ₹{{ $coupon->discount_value }}
                        @else
                        {{ $coupon->discount_value }}%
                        @endif

                        @if($coupon->max_discount)
                        <small class="text-muted">(Max ₹{{ $coupon->max_discount }})</small>
                        @endif
                    </td>

                    <td>
                        {{ $coupon->min_cart_value ? '₹'.$coupon->min_cart_value : '-' }}
                    </td>

                    <td>{{ $coupon->valid_from }}</td>
                    <td>{{ $coupon->valid_to }}</td>

                    <td>
                        @if($coupon->status == 1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('admin.coupon.destroy', $coupon->id) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this coupon?');">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center">No coupons found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection