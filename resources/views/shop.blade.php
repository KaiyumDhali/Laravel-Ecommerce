@extends('layout.app')
@section('title', 'Shop')

@section('content')
<main class="page-content mb-5">
    <section class="featured-section bg-img">
        <div class="container">

            @php
                $selectedCategoryId = request()->query('category'); // ?category=3
                $selectedCategoryName = null;
                if($selectedCategoryId){
                    $selectedCategory = $categories->firstWhere('id', $selectedCategoryId);
                    $selectedCategoryName = $selectedCategory ? $selectedCategory->name : null;
                }
            @endphp

            {{-- Filter Menu / Category Name --}}
            @if(!$selectedCategoryId)
                <div class="filter-menu text-center mb-4">
                    <ul class="button-group sort-button-group list-unstyled d-inline-flex gap-3">
                        <li class="button active" data-category="all">All <span>{{ $products->count() }}</span></li>
                        @foreach($categories as $category)
                            <li class="button" data-category="cat-{{ $category->id }}">
                                {{ $category->name }} <span>{{ $category->products_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="filter-menu text-center mb-4">
                    <h1 class=""><span class="text-black button">{{ $selectedCategoryName }}</span></h1>
                </div>
            @endif

            {{-- Products Grid --}}
            <div class="row g-4 container">
                @foreach($products as $product)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2-4 mb-4 product-item cat-{{ $product->category_id }}" data-category="cat-{{ $product->category_id }}">
                        <div class="card border-0 h-100 rounded-5 overflow-hidden shadow-lg position-relative">
                            <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" style="height:200px; object-fit:cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                                </h5>
                                <p class="fw-bold">৳{{ number_format($product->price,2) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary w-100">Add to Cart</a>
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

{{-- JS filter for body buttons --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.sort-button-group .button');
    const products = document.querySelectorAll('.product-item');

    if(buttons.length > 0) {
        products.forEach(product => product.style.display = 'block');

        buttons.forEach(button => {
            button.addEventListener('click', function(e){
                e.preventDefault();
                const category = this.getAttribute('data-category');

                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                products.forEach(product => {
                    product.style.display = (category === 'all' || product.getAttribute('data-category') === category) ? 'block' : 'none';
                });
            });
        });
    }
});
</script>
@endsection
