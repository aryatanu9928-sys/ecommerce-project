<!DOCTYPE html>
<html>

<head>
    <title>Order Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Order Invoice</h2>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Name:</strong> {{ $order->name }}</p>
    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
    <p><strong>Total Price:</strong> ₹{{ $order->total_price }}</p>

    <hr>

    <h3>Ordered Products</h3>

    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>

        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹{{ $item->price }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>