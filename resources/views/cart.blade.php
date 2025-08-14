@extends('layout.app')
@section('title', 'Shopping Cart')

@section('content')

<section class="cart-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 table-responsive">
                <h1 class="text-center mb-4 display-4">Your Cart</h1>
                @if(count($cartItems) > 0)
                <div class="col-md-12">


                </div>
                <table class="table table-hover table-borderless">
                    <thead class="thead-light">
                        <tr>
                            
                            <th scope="col">Product Info.</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($cartItems as $id => $item)
                        <tr class="align-middle cart-item">
                            
                            <td class="align-middle d-flex">
                                <!-- Product Image with Hover Effect -->
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded-circle shadow product-image" style="width: 60px; height: 60px; object-fit: cover; margin-right: 10px;">
                                <strong class="ms-3">{{ $item['name'] }}</strong>
                            </td>
                            <td class="align-middle text-muted">৳{{ number_format($item['price'], 2) }}</td>
                            

                            <td class="align-middle">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')


                                    
                                    <div class="input-group justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease" style="margin-right: 5px;">-</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control quantity-input text-center" data-original-quantity="{{ $item['quantity'] }}" style="width: 60px; margin: 0 5px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase" style="margin-left: 5px;">+</button>
                                    </div>
                                    
                                </form>
                            </td>
                            <td class="align-middle fw-bold item-total">৳{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="align-middle text-muted">{{ $item['size'] }}</td>
                            <td class="align-middle text-muted">{{ $item['color'] }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" style="font-size: 1.1rem; background: red; color: #fff; 
                                        border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                                        transition: background 0.4s ease, box-shadow 0.3s ease;">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-total text-end my-4">
                    <h3>Total: <strong>৳<span id="cart-total">{{ number_format($cartTotal, 2) }}</span></strong></h3>
                    <a href="{{ route('checkout') }}" class="btn btn-lg btn-primary mt-3 px-5 rounded-pill shadow-lg checkout-btn" style="margin-bottom: 100px;font-size: 2.1rem; 
                        border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                        transition: background 0.4s ease, box-shadow 0.3s ease;">Proceed to Checkout</a>
                </div>
                @else
                <div class="text-center py-5">
                    <h3>Your cart is currently empty</h3>
                    <a href="{{ route('index.view') }}" class="add-to-cart-btn btn btn-lg btn-outline-secondary mt-3 px-4 rounded-pill"style="font-size: 1.1rem; background: linear-gradient( #f5b000, #F65421); color: #fff; 
                        border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                        transition: background 0.4s ease, box-shadow 0.3s ease;">Continue Shopping</a>
                </div>
                @endif

                
            </div>
        </div>
    </div>
</section>
@endsection
