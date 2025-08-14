@extends('layout.app')
@section('title' ,'loin')


@section('content')

<main class="page-content mb-5">
<section class="search-section">
            <div class="container">
                <div class="row subscribe-from">
                    <div class="col-md-12">
                        <form class="form-inline col-md-12 wow fadeInDown animated">
                            <div class="form-group">
                                <input type="email" class="form-control subscribe" id="email" placeholder="Search...">
                                <button class="suscribe-btn" ><i class="pe-7s-search"></i></button>
                            </div>
                        </form><!-- end /. form -->
                    </div>
                </div><!-- end of/. row -->
            </div><!-- end of /.container -->
        </section><!-- end of /.news letter section -->

        <section class="slider-section">
           
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000">
                <!-- Indicators -->
                <ol class="carousel-indicators slider-indicators">
                    @foreach($sliders as $key => $slider)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($sliders as $key => $slider)
                        <div class="item {{ $key == 0 ? 'active' : '' }}" style="height:455px;">
                            <img src="{{ asset($slider->image) }}"alt="">
                            <div class="carousel-caption">
                                <h2>{{ $slider->title }}</h2>
                                <h3>{{ $slider->subtitle }} <span>SALE</span></h3>
                                <a href="{{ $slider->link }}">Buy Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" >
                    <span class="pe-7s-angle-left glyphicon-chevron-left" aria-hidden="true" ></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="pe-7s-angle-right glyphicon-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
           

</section>

        <section class="service-section" style="padding: 18px; margin: 18px;"
        >
            <div class="container">
                <div class="row" >
                    <div class="col-md-3 col-sm-6 wow fadeInRight animated" data-wow-delay="0.1s">
                    <div class="service-item text-center small">
                            <i class="pe-7s-rocket" style="font-size: 28px;"></i>
                            <p class="mb-0"><strong>Free Delivery</strong> | For all orders over $99</p>
                    </div>

                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInRight animated" data-wow-delay="0.2s">
                        <div class="service-item text-center small">
                            <!-- <i class="pe-7s-safe"></i> -->
                            <i class="pe-7s-refresh" style="font-size: 28px;"></i> <!-- Sync/refresh icon -->
                           <p class="mb-0"><strong>90 Days Return</strong> | If goods have problems</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInRight animated" data-wow-delay="0.3s">
                        <div class="service-item text-center small">
                            <!-- <i class="pe-7s-global"></i> -->
                            <i class="pe-7s-credit" style="font-size: 28px;"></i> <!-- This is the closest match for payment -->
                           <p class="mb-0"><strong>Secure Payment</strong> | 100% secure payment</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInRight animated" data-wow-delay="0.4s">
                    <div class="service-item text-center small">
                        <i class="pe-7s-headphones" style="font-size: 28px;"></i>
                        <p class="mb-0"><strong>24/7 Support</strong> | Dedicated support</p>
                    </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="bg-light">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-4 text-center">
    <h2 class="fw-bold display-5 text-dark full-underline">New Collection</h2>
</div>


        
        <!-- Product Grid -->
        <div class="row">
            @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-4 mb-4">

                    <div class="card product-item border-0 h-100 rounded-5 overflow-hidden  position-relative" style="transition: transform 0.3s ease;">
                        <!-- Product Image with Overlay -->
                        <div class="product-img-wrapper position-relative">
                            <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 200px; transition: transform 0.3s ease;" alt="{{ $product->name }}">
                            <div class="product-overlay position-absolute top-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <!-- Product Title -->
                           <h5 class="card-title text-center mt-3 fw-semibold">
                                <a href="{{ route('product.show', $product->id) }}" 
                                class="text-decoration-none " style="color: black; font-size: 1.7rem;">
                                {{ $product->name }}
                                </a>
                            </h5>

                            <!-- Price -->
                            <p class="card-text text-center text-black fw-semibold fs-4">৳{{ number_format($product->price, 2) }}</p>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <div class="card-footer bg-transparent border-0 text-center p-3">
                           
                                <a href="{{ route('product.show', $product->id) }}"class="add-to-cart-btn btn rounded-pill py-2 px-4 d-flex align-items-center justify-content-center" 
                                        style="font-size: 1.7rem; background: linear-gradient( #F65421); color: #fff; 
                                            border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                                            transition: background 0.4s ease, box-shadow 0.3s ease; height:35px; width : 100%;"
                                        data-id="{{ $product->id }}">
                                    <i class="pe-7s-cart" style="font-size: 1.8rem; margin-right: 0.5rem;"></i> Add to Cart
                                </a>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
        <section class="featured-section bg-img">
               <div class="container">

                    {{-- Section Title --}}
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h2 class="fw-bold display-5 text-dark full-underline">Featured Products</h2>
                        </div>
                    </div>
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

        <section class="best-seller-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <div class="row mb-4 text-center">
                        <h2 class="fw-bold display-5 text-dark full-underline">Best Sellers</h2>
                    </div>
                                        </div>
                </div>
                <div class="row">
            @foreach($bestSellers as $bestSeller)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-item border-0 h-100 rounded-5 overflow-hidden shadow-lg position-relative" style="transition: transform 0.3s ease;">
                        <!-- Product Image with Overlay -->
                        <div class="product-img-wrapper position-relative">
                            <img src="{{ asset($bestSeller->image) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 200px; transition: transform 0.3s ease;" alt="{{ $product->name }}">
                            <div class="product-overlay position-absolute top-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <!-- Product Title -->
                            <h5 class="card-title text-center mt-3 text-dark fw-semibold">
                                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark" style="color: black; font-size: 1.7rem;">{{ $bestSeller->name }}</a>
                            </h5>
                            <!-- Price -->
                            <p class="card-text text-center text-black fw-bold fs-4">৳{{ number_format($bestSeller->price, 2) }}</p>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <div class="card-footer bg-transparent border-0 text-center p-3">
                            
                                <a href="{{ route('product.show', $product->id) }}" class="add-to-cart-btn btn rounded-pill py-2 px-4 d-flex align-items-center justify-content-center" 
                                            style="font-size: 1.7rem; background: linear-gradient( #F65421); color: #fff; 
                                            border: none; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.2); 
                                            transition: background 0.4s ease, box-shadow 0.3s ease; height:35px; width : 100%;"
                                            data-id="{{ $product->id }}">
                                            <i class="pe-7s-cart" style="font-size: 1.8rem; margin-right: 0.5rem;"></i> Add to Cart
                                </a>
                         
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            </div>
        </section>

        <section class="review-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row mb-4 text-center">
                            <h2 class="fw-bold display-5 text-dark full-underline">Customer Review</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="feedback" class="carousel slide feedback" data-ride="feedback">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="images/member1.png" width="320" height="439" alt="">
                                <div class="carousel-caption">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, </p>
                                    <h3>- Olivia -</h3>
                                    <span>Melbour, Aus</span>
                                </div>
                            </div>
                            <div class="item">
                                <img src="images/member2.png" width="320" height="439" alt="">
                                <div class="carousel-caption">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, </p>
                                    <h3>- Olivia -</h3>
                                    <span>Melbour, Aus</span>
                                </div>
                            </div>
                            <div class="item">
                                <img src="images/member3.png" width="320" height="439" alt="">
                                <div class="carousel-caption">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, </p>
                                    <h3>- Olivia -</h3>
                                    <span>Melbour, Aus</span>
                                </div>
                            </div>
                        </div>
                        <!-- Indicators -->
                        <ol class="carousel-indicators review-controlar">
                            <li data-target="#feedback" data-slide-to="0" class="active">
                                <img src="images/member1.png" width="320" height="439" alt="">
                            </li>
                            <li data-target="#feedback" data-slide-to="1">
                                <img src="images/member2.png" width="320" height="439" alt="">
                            </li>
                            <li data-target="#feedback" data-slide-to="2">
                                <img src="images/member3.png" width="320" height="439" alt="">
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
<!-- end of /.news letter section -->
<section class="client-section">
    <div class="container">
        <div class="row mb-4 text-center">
            <h2 class="fw-bold display-5 text-dark full-underline">Our Partners</h2>
        </div>

        <div id="client" class="row owl-carousel owl-theme client-area">
            @foreach($partners as $partner)
                <div class="col-md-12 item">
                    <a href="{{ $partner->link ?? '#' }}">
                        <img src="{{ asset($partner->image) }}" class="img-responsive" style="height:130px; width: 150px;"  alt="{{ $partner->name }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="customNavigation works-navigation">
            <a class="btn-work works-prev"><i class="pe-7s-angle-left"></i></a>
            <a class="btn-work works-next"><i class="pe-7s-angle-right"></i></a>
        </div>
    </div>
</section>

  <section class="news-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row mb-4 text-center">
                    <h2 class="fw-bold display-5 text-dark full-underline">Latest News</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($news as $item)
                <div class="col-sm-4 wow fadeInDown animated" data-wow-delay="0.2s">
                    <div class="blog-item">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" width="350" height="262" alt="{{ $item->title }}">
                        </a>
                        <h3>{{ Str::limit($item->title, 50) }}</h3>
                        <p>{{ Str::limit($item->description, 120) }}</p>
                        <a href="{{ route('news.show', $item->id) }}">Read More</a>
                    </div>
                </div>
            @endforeach
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