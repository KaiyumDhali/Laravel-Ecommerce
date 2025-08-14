<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Receipt</title>
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <h1>Order Receipt</h1>
    <p>Thank you for your order!</p>
    <p>Order ID: {{ $order->id }}</p>
    <p>Customer Name: {{ $order->user_name }}</p>
</body>
</html>
