@extends('layout.app')
@section('title' ,'loin')


@section('content')

<main class="page-content mb-5">
        <section class="featured-section bg-img">
               <div class="container">

                    {{-- Section Title --}}
                    <div class="filter-menu text-center"> 
                        <ul class="button-group sort-button-group list-unstyled d-inline-flex gap-3"> 
                            <li class="button active" data-category="all">All <span>{{ $products->count() }}</span></li> 
                             @foreach($categories as $category)
                                    <li class="button" data-category="cat-{{ $category->id }}">
                                        {{ $category->name }} <span>{{ $category->products_count }}</span>
                                    </li>
                                @endforeach
                        </ul> 
                    </div>
                    
                    

                    {{-- Products Grid --}}
                    <div class="row g-4 container">
                        @foreach($products as $Product)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2-4 mb-4 product-item cat-{{ $Product->category_id }}" 
                                data-category="cat-{{ $Product->category_id }}">
                                
                                <div class="card border-0 h-100 rounded-5 overflow-hidden shadow-lg position-relative" style="transition: transform 0.3s ease;">
                                    
                                    {{-- Product Image --}}
                                    <div class="position-relative">
                                        <img src="{{ asset($Product->image) }}" 
                                            class="card-img-top img-fluid" 
                                            style="object-fit: cover;  transition: transform 0.3s ease;height: 200px;" 
                                            alt="{{ $Product->name }}">
                                        <div class="position-absolute top-0 w-100 h-100" 
                                            style="background: rgba(0,0,0,0.25); opacity: 0; transition: opacity 0.3s ease;">
                                        </div>
                                    </div>

                                    {{-- Card Body --}}
                                    <div class="card-body d-flex flex-column justify-content-between p-3 p-md-4">
                                        <h5 class="card-title text-center mt-3 text-dark fw-semibold">
                                            <a href="{{ route('product.show', $Product->id) }}" class="text-decoration-none text-dark" style="color: black; font-size: 1.7rem;">
                                                {{ $Product->name }}
                                            </a>
                                        </h5>
                                        <p class="card-text text-center text-black fw-bold fs-5">
                                            ৳{{ number_format($Product->price, 2) }}
                                        </p>
                                    </div>

                                    {{-- Add to Cart --}}
                                    <div class="card-footer bg-transparent border-0 text-center p-3">
                                        <a href="{{ route('product.show', $Product->id) }}" 
                                        class="btn rounded-pill py-2 px-4 d-flex align-items-center justify-content-center" 
                                       style="font-size: 1.7rem; background: linear-gradient( #F65421); color: #fff; 
                                            border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                                            transition: background 0.4s ease, box-shadow 0.3s ease; height:35px; width : 100%;">
                                            <i class="pe-7s-cart me-2" style="font-size: 1.4rem;"></i> Add to Cart
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </section>


        <section class="offer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInDown animated ">
                        <h1>END OF SEASON SALE</h1>
                        <h2>Up to 35% off Women's Denim</h2>
                    </div>
                </div>
            </div>
        </section>

     
</main>
{{-- Filter JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.sort-button-group .button');
            const products = document.querySelectorAll('.product-item');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.getAttribute('data-category');

                    products.forEach(product => {
                        if (category === 'all') {
                            product.style.display = 'block';
                        } else {
                            if (product.getAttribute('data-category') === category) {
                                product.style.display = 'block';
                            } else {
                                product.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>

@endsection