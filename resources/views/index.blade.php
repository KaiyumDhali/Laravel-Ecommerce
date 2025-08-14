@extends('layout.app')
@section('title' ,'loin')
<style>
    @media (min-width: 992px) {
        .col-lg-2-4 {
            width: 20%;
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
</style>

<style>
    .full-underline {
        display: inline-block;
        border-bottom: 3px solid #F65421; /* Adjust thickness and color */
        padding-bottom: 5px; /* Space between text and underline */
    }
</style>


<style>

.service-item {
        text-align: center;
        font-size: 14px; /* Smaller text */
    }

    .service-item i {
        font-size: 28px; /* Smaller icons */
        margin-bottom: 10px;
        display: inline-block;
    }

    .service-item h1,
    .service-item h3 {
        font-size: 16px; /* Smaller headings */
        margin: 10px 0;
    }

    .service-item p {
        font-size: 13px;
    }
    .product-item:hover {
        transform: scale(1.05); /* Slightly increase card size on hover */
    }

    .product-img-wrapper:hover .product-overlay {
        opacity: 1; /* Show overlay on hover */
    }

    .product-overlay {
        background: rgba(0, 0, 0, 0.35); /* Dark overlay on image */
        transition: opacity 0.3s ease;
    }

    .card-footer button:hover {
        background: #343a40 !important; /* Darker hover effect for the button */
        color: #fff !important;
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #e9a826, #bf7b00); /* Slightly darker gradient */
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.3), 0 0 15px rgba(245, 176, 66, 0.5); /* Glow effect */
    }

    .add-to-cart-btn:active {
        transform: scale(0.98); /* Slight shrink effect on click */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15); /* Lower shadow for pressed effect */
    }

    .add-to-cart-btn i {
        transition: transform 0.3s ease; /* Smooth icon animation */
    }

    .add-to-cart-btn:hover i {
        transform: scale(1.1); /* Icon enlarges slightly on hover */
    }
</style>
@section('content')


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
           
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators slider-indicators">
                    @foreach($sliders as $key => $slider)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($sliders as $key => $slider)
                        <div class="item {{ $key == 0 ? 'active' : '' }}" style="height:355px;">
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
                <div class="row">
                    <div class="col-md-12">
                    <div class="row mb-4 text-center">
                        <h2 class="fw-bold display-5 text-dark full-underline">Featured Products</h2>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-menu">
                            <ul class="button-group sort-button-group">
                                <li class="button active" data-category="all" >All<span>8</span></li>
                                <li class="button" data-category="cat-1">Dresses and Suits<span>2</span></li>
                                <li class="button" data-category="cat-2">Accessories<span>2</span></li>
                                <li class="button" data-category="cat-3">Miscellaneous<span>4</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
            @foreach($featuredProducts as $featuredProduct)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-item border-0 h-100 rounded-5 overflow-hidden shadow-lg position-relative" style="transition: transform 0.3s ease;">
                        <!-- Product Image with Overlay -->
                        <div class="product-img-wrapper position-relative">
                            <img src="{{ asset($featuredProduct->image) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 355px; transition: transform 0.3s ease;" alt="{{ $product->name }}">
                            <div class="product-overlay position-absolute top-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <!-- Product Title -->
                            <h5 class="card-title text-center mt-3 text-dark fw-semibold">
                                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">{{ $featuredProduct->name }}</a>
                            </h5>
                            <!-- Price -->
                            <p class="card-text text-center text-primary fw-bold fs-4">৳{{ number_format($featuredProduct->price, 2) }}</p>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <div class="card-footer bg-transparent border-0 text-center p-3">
                            
                                <a href="{{ route('product.show', $product->id) }}" class="add-to-cart-btn btn rounded-pill py-2 px-4 d-flex align-items-center justify-content-center" 
        style="font-size: 1.7rem; background: linear-gradient( #f5b000, #F65421); color: #fff; 
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
                            <img src="{{ asset($bestSeller->image) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 355px; transition: transform 0.3s ease;" alt="{{ $product->name }}">
                            <div class="product-overlay position-absolute top-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <!-- Product Title -->
                            <h5 class="card-title text-center mt-3 text-dark fw-semibold">
                                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">{{ $bestSeller->name }}</a>
                            </h5>
                            <!-- Price -->
                            <p class="card-text text-center text-primary fw-bold fs-4">৳{{ number_format($bestSeller->price, 2) }}</p>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <div class="card-footer bg-transparent border-0 text-center p-3">
                            
                                <a href="{{ route('product.show', $product->id) }}" class="add-to-cart-btn btn rounded-pill py-2 px-4 d-flex align-items-center justify-content-center" 
        style="font-size: 1.7rem; background: linear-gradient( #f5b000, #F65421); color: #fff; 
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

        <section class="news-letter-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row mb-4 text-center">
                            <h2 class="fw-bold display-5 text-dark full-underline">Newsletter</h2>
                        </div>
                                                <p>Follow a collection of news & promotions</p>
                                            </div>
                </div>
                <div class="row subscribe-from">
                    <form class="form-inline col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1  wow fadeInDown animated">
                        <div class="form-group">
                            <input type="email" class="form-control subscribe" id="email" placeholder="Enter your email">
                            <button class="suscribe-btn" ><i class="pe-7s-next"></i></button>
                        </div>
                    </form><!-- end /. form -->
                </div><!-- end of/. row -->
            </div><!-- end of /.container -->
        </section><!-- end of /.news letter section -->

        <section class="client-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row mb-4 text-center">
                            <h2 class="fw-bold display-5 text-dark full-underline">our partner</h2>
                        </div>`
                    </div>
                </div>
                <div id="client" class="row owl-carousel owl-theme client-area">
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_01.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_02.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_03.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_04.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_01.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_02.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_03.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                    <div class="col-md-12 item">
                        <a href="#">
                            <img src="images/client_04.jpg" class="img-responsive" width="300" height="200" alt="">
                        </a>
                    </div>
                </div>
                <div class="customNavigation works-navigation">
                    <a class="btn-work works-prev"><i class="pe-7s-angle-left"></i></a>
                    <a class="btn-work works-next"><i class="pe-7s-angle-right"></i></a>
                </div><!-- end of /.client navigation -->
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
                <div class="row" >
                    <div class="col-sm-4 wow fadeInDown animated" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <a href="#"><img src="images/blog1.jpg" width="350" height="262" alt=""></a>
                            <h3>Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean </h3>
                            <p>Nam nec tellus a odio tincidunt auc. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInDown animated" data-wow-delay="0.4s">
                        <div class="blog-item">
                            <a href="#"><img src="images/blog2.jpg" width="350" height="262" alt=""></a>
                            <h3>Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean </h3>
                            <p>Nam nec tellus a odio tincidunt auc. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt</p>
                            <a href="#">Read More</a>

                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInDown animated" data-wow-delay="0.6s">
                        <div class="blog-item">
                            <a href="#"><img src="images/blog3.jpg" width="350" height="262" alt=""></a>
                            <h3>Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean </h3>
                            <p>Nam nec tellus a odio tincidunt auc. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@endsection