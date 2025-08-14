@extends('layout.app')

@section('content')
<section class="product-details-section " style="background-color: #f9f9f9; ">
    <div class="container">
        <!-- Product Details Row -->
        <div class="row align-items-center gx-5 gy-4">
            <!-- Product Image Section -->
            <div class="col-lg-5 text-center">
                <div class="product-image"style="padding:30px;mergine:30px; max-width: 100%; max-height: 450px; overflow: hidden;">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                         class="img-fluid rounded shadow-sm mb-4" 
                         style="border: 1px solid #eee; max-height: 500px; object-fit: contain;">
                </div>
                
                @if($product->gallery && is_array(json_decode($product->gallery)))
                <div class="gallery-images d-flex justify-content-center gap-2 flex-wrap" style="padding:30px;margin:30px;">
                    @foreach(json_decode($product->gallery) as $galleryImage)
                        <img src="{{ asset($galleryImage) }}" 
                             class="rounded shadow-sm" 
                             alt="Gallery Image" 
                             style="height: 100px; width: 100px; object-fit: cover; cursor: pointer;" 
                             onclick="document.querySelector('.product-image img').src='{{ asset($galleryImage) }}'">
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-1"></div>
            <!-- Product Information Section -->
            <div class="col-lg-5">
                <h1 class="mb-3" style="font-size: 28px; font-weight: 700; color: #333;">{{ $product->name }}</h1>
                <p class="text-muted mb-2">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
                <h2 class="text-danger mb-4" style="font-size: 18px;">Price: ৳ {{ number_format($product->price, 2) }}</h2>
                
                <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <!-- Size Selection -->
                    <div class="mb-4">
                        <label for="size" class="form-label" style="font-weight: 600; font-size: 13px; padding-top:10px;margin-top:10px;">Size:</label>
                        <select name="size" id="size" class="form-select" 
                                style="padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff; padding-left:20px;margin-left:45px;">
                            <option value="" disabled selected>Select Size</option>
                            @foreach($product->sizes as $size)
                                <option value="{{ $size->size }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-4">
                        <label for="color" class="form-label" style="font-weight: 600; font-size: 13px; padding-top:10px;margin-top:15px;">Color:</label>
                        <select name="color" id="color" class="form-select" 
                                style="padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff; padding-left:20px;margin-left:35px;">
                            <option value="" disabled selected>Select Color</option>
                            @foreach($product->colors as $color)
                                <option value="{{ $color->color }}">{{ $color->color }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-4 ">
                        <label for="quantity" class="form-label" style="font-weight: 600; font-size: 13px; padding-top:10px;margin-top:15px;">Quantity:</label>
                        <input type="number" class="" 
                               name="quantity" id="quantity" min="1" value="1" required 
                               style="width: 20%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; padding-left:10px;margin-left:15px;">
                    </div>

                    <!-- Add to Cart Button -->
                    <button type="button" id="add-to-cart-btn" 
                            class="btn btn-primary btn-lg rounded-pill shadow-sm" 
                            style="background: linear-gradient(90deg, #ff7e5f, #feb47b); border: none; padding-top:10px;margin-top:30px;">
                        <i class="pe-7s-cart me-2"></i> Add to Cart
                    </button>
                </form>

                <p class="mt-4 text-muted" style="font-size: 13px; line-height: 1.8; padding-top:10px;margin-top:40px;">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('add-to-cart-btn').addEventListener('click', function () {
        const form = document.getElementById('add-to-cart-form');
        const size = document.getElementById('size').value;
        const color = document.getElementById('color').value;
        const quantity = document.getElementById('quantity').value;

        // Validation SweetAlert
        if (!size || !color || !quantity) {
            Swal.fire({
                title: 'Missing Information',
                text: 'Please select size, color, and quantity before adding to the cart.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Confirmation SweetAlert
        Swal.fire({
            title: 'Add to Cart?',
            text: `Size: ${size}, Color: ${color}, Quantity: ${quantity}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Add it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form via AJAX
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Update cart total and count in layout
                        const cartTotalElement = document.getElementById('cart-total');
                        const cartCountElement = document.getElementById('cart-count');

                        if (cartTotalElement) {
                            cartTotalElement.textContent = '৳' + parseFloat(data.cartTotal).toFixed(2);
                        }

                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }

                        // Success Alert
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to add the product to the cart.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    });
</script>

@endsection
