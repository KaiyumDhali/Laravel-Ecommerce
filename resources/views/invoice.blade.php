<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .header {
            margin-bottom: 20px;
        }
    </style>
    <script>
        window.onload = function() {
            // Trigger the print dialog
            window.print();

            // Navigate back to the order list after printing is complete
            window.onafterprint = function() {
                window.location.href = "{{ route('orders.index') }}";
            };
        };
    </script>
</head>
<body>
    <div class="header">
        <h1>Invoice #{{ $order->id }}</h1>
        <p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
        <p><strong>User Name:</strong> {{ $order->user_name }}</p>
        <p><strong>Delivery Address:</strong> {{ $order->full_address }}, {{ $order->City }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (৳)</th>
                <th>Subtotal (৳)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price, 2) }}</td>
                    <td>{{ number_format($detail->quantity * $detail->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Total Amount:</th>
                <th>৳{{ number_format($order->total_amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
