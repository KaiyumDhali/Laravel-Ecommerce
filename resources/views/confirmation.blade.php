@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h1>Order Confirmation</h1>
            </div>
            <div class="card-body">
                <h3 class="text-center">Thank you for your order!</h3>
                <p class="text-center">Your order has been successfully placed. Below are the details:</p>

                <div class="mb-4">
                    <h5>Order ID: <strong>{{ $order->id }}</strong></h5>
                    <h5>Customer Name: <strong>{{ $order->user_name }}</strong></h5>
                    <h5>Total Amount: <strong>${{ number_format($order->total_amount, 2) }}</strong></h5>
                    <h5>Status: <strong>{{ ucfirst($order->status) }}</strong></h5>
                </div>

                <h5 class="mt-4">Order Details:</h5>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <a href="{{ route('index.view') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
