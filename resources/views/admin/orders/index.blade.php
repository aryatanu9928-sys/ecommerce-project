@extends('admin.layouts.admin')

@section('title', 'Orders List')

@section('content')
<div class="container mt-4">
    <h2>Orders List</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>₹{{ $order->total_price }}</td>

                <td>
                    <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-sm btn-primary">
                        View
                    </a>

                    <a href="{{ route('admin.orders.pdf', $order->id) }}" class="btn btn-sm btn-success">
                        PDF
                    </a>
                </td>


            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No orders found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection