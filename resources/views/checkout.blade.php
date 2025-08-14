@extends('layout.app')
@section('title', 'Checkout')

@section('content')
<section class="checkout-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Checkout</h1>
                        
                        <!-- Checkout Form -->
                        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <!-- Customer ID -->
                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                            <input type="hidden" name="user_name" value="{{ session('user_name') }}">
                            <input type="hidden" name="user_phone" value="{{ session('phone') }}">
                            <input type="hidden" name="user_email" value="{{ session('email') }}">
                            <input type="hidden" name="status" value="pending">

                            <!-- Hidden Cart Data -->
                            @foreach($cartItems as $id => $item)
                            <input type="hidden" name="products[{{ $id }}][id]" value="{{ $item['id'] }}">  <!-- Product ID -->
                            <input type="hidden" name="products[{{ $id }}][name]" value="{{ $item['name'] }}">
                            <input type="hidden" name="products[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                            <input type="hidden" name="products[{{ $id }}][price]" value="{{ $item['price'] }}">
                            <input type="hidden" name="products[{{ $id }}][image]" value="{{ $item['image'] }}">
                            <input type="hidden" name="size" value="{{ $item['size'] }}">
                            <input type="hidden" name="color" value="{{ $item['color'] }}">
                            @endforeach


                            <div class="form-group mb-3">
                                <label for="city">City</label>
                                <select name="City" class="form-control" required>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Barisal">Barisal</option>
                                </select>
                            </div>


                            <!-- Shipping Address -->
                            <div class="form-group mb-3">
                                <label for="full_address">Full Address</label>
                                <input type="text" name="full_address" class="form-control" placeholder="Enter your shipping address" required>
                            </div>



                            <!-- Payment Method -->
                            <div class="form-group mb-3">
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="credit_card">COD</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>

                            <!-- Checkout Summary -->
                            <div class="checkout-summary text-end mb-4">
                                <h3>Total: <strong>৳{{ number_format($cartTotal, 2) }}</strong></h3>
                            </div>

                            <!-- Place Order Button -->
                            <button type="button" onclick="submitCheckoutForm()" class="btn btn-success btn-lg btn-block" style="font-size: 1.1rem; background: linear-gradient(#f5b000, #F65421); color: #fff; border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); transition: background 0.4s ease, box-shadow 0.3s ease;">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .checkout-section {
        background-color: #f8f9fa;
        padding: 40px 0;
    }

    .card {
        border-radius: 10px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .checkout-summary h3 {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function submitCheckoutForm() {
    const form = document.getElementById('checkoutForm');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
    console.log('Response Data:', data);
    if (data.success) {
        Swal.fire({
            icon: 'success',
            title: 'Order Confirmed!',
            text: 'Your order has been successfully processed.',
            showConfirmButton: true,
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/';
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Order Failed',
            text: 'There was an issue processing your order. Please try again.',
            showConfirmButton: true,
            confirmButtonText: 'Retry'
        });
    }
})

}
</script>

@endsection
