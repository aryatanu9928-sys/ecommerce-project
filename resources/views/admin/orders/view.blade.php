@extends('admin.layouts.admin')

@section('title','Order Details')

@section('content')
<style>
    /* General container */
    .order-container {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    h3,
    h5 {
        color: #333;
    }

    /* Customer Info Styling */
    .customer-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 5px solid #0d6efd;
        margin-bottom: 20px;
    }

    .customer-info p {
        margin-bottom: 8px;
        font-size: 15px;
        display: flex;
        align-items: center;
    }

    .customer-info p i {
        margin-right: 10px;
        color: #0d6efd;
        width: 20px;
        text-align: center;
    }

    /* Table styling */
    table {
        width: 100%;
    }

    table th,
    table td {
        text-align: left;
        vertical-align: middle !important;
    }

    table thead {
        background-color: #f8f9fa;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Summary table */
    .order-summary {
        max-width: 400px;
        margin-top: 20px;
        float: right;
    }

    .order-summary th {
        width: 60%;
    }

    .order-summary td,
    .order-summary th {
        padding: 10px;
        font-size: 15px;
    }

    .order-summary tr.table-light {
        background-color: #e9ecef;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .order-summary {
            float: none;
            max-width: 100%;
        }
    }
</style>

<div class="container mt-4 order-container">
    <h3 class="mb-4">Order #{{ $order->id }}</h3>

    <!-- Customer Info -->
    <div class="customer-info">
        <h5>Customer Information</h5>
        <p><i class="bi bi-person-fill"></i> <b>Name:</b> {{ $order->name }}</p>
        <p><i class="bi bi-envelope-fill"></i> <b>Email:</b> {{ $order->email }}</p>
        <p><i class="bi bi-telephone-fill"></i> <b>Phone:</b> {{ $order->phone }}</p>
        <p><i class="bi bi-geo-alt-fill"></i> <b>Address:</b> {{ $order->address }}</p>
        <p><i class="bi bi-credit-card-2-front-fill"></i> <b>Payment Method:</b> {{ $order->payment_method }}</p>
    </div>

    <hr>

    <!-- Ordered Products -->
    <h5>Ordered Products</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price (₹)</th>
                <th>Subtotal (₹)</th>
            </tr>
        </thead>
        <tbody>
            @php $subtotal = 0; @endphp
            @foreach($order->items as $item)
            @php
            $itemSubtotal = $item->quantity * $item->price;
            $subtotal += $itemSubtotal;
            @endphp
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price,2) }}</td>
                <td>₹{{ number_format($itemSubtotal,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Order Summary -->
    <div class="order-summary">
        <h5>Order Summary</h5>
        <table class="table table-bordered">
            <tr>
                <th>Subtotal:</th>
                <td>₹{{ number_format($subtotal,2) }}</td>
            </tr>
            <tr>
                <th>Shipping:</th>
                <td>₹{{ number_format($order->shipping_cost ?? 0,2) }}</td>
            </tr>
            <tr>
                <th>Tax:</th>
                <td>₹{{ number_format($order->tax ?? 0,2) }}</td>
            </tr>
            <tr>
                <th>Coupon Discount:</th>
                <td>- ₹{{ number_format($order->coupon_discount ?? 0,2) }}</td>
            </tr>
            <tr class="table-light">
                <th>Total:</th>
                <td>₹{{ number_format($order->total_price,2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>
</div>
@endsection