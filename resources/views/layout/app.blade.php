<!doctype html>
<html class="no-js" lang="en">
@include('layout.facebook-pixel')

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('NRB-Ecommerce')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
       
        <link rel="icon" href="{{ asset('images/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GN5oMI43y8KZ8Iq8ETxGdF/7Q9PTh9odlPSRxeb9YEXcLjUJnSoFbRpAZfoUQl5g" crossorigin="anonymous">
        
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
        <!-- PRELOADER -->
        <div id="preloader">
            <div class="preloader-area">
                <div class="preloader-box">
                    <div class="preloader"></div>
                </div>
            </div>
        </div>

        <!-- HEADER TOP SECTION -->
        <section class="header-top-section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="header-top-content">
                            <ul class="nav nav-pills navbar-left">
                                <li><a href="#"><i class="pe-7s-call"></i><span>123-123456789</span></a></li>
                                <li><a href="#"><i class="pe-7s-mail"></i><span> info@mart.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="header-top-menu text-right">
                            <ul class="nav nav-pills navbar-right">
                                <li><a href="{{route('admin.accounts.index')}}">My Account</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="{{ route('cart.view') }}">Cart</a></li>
                                <li><a href="#">Checkout</a></li>
                                
                                <!-- Check if user is logged in -->
                                @if(session('user_name'))
                                    <li class="dropdown">
                                        
                                            <span class="glyphicon glyphicon-user dropbtn"></span> {{ session('user_name') }}
                                        
                                        <div class="dropdown-content">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li><a href="{{ route('login.log') }}"><i class="pe-7s-lock"></i> Login/Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN NAVIGATION -->
        <header class="header-section">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{route('index.view')}}"><b>NRB</b>E-commerce</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="#">Page</a></li>
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right cart-menu">
    <li><a href="#" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></a></li>
    <li>
   
        <a href="{{route('cart.view')}}">
            <span>Cart:</span>
        
            <span class="cart-info ">
<strong id="cart-total">৳{{ number_format($cartTotal, 2) }}</strong>
                &nbsp;|&nbsp;
                <i class="fa fa-shopping-cart"></i> 
                <span id="cart-count">{{ count(session('cart', [])) }}</span>
            </span>

        </a>
    </li>
</ul>

                    </div>
                </div>
            </nav>
        </header>

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- CONTACT SECTION -->
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-section wow fadeInDown animated">
                            <h1>GET IN TOUCH</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 wow fadeInLeft animated">
                        <div class="left-content">
                            <h1><span>M</span>art</h1>
                            <h3>We'd love to meet you in person or via the web!</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel nulla sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                            <div class="contact-info">
                                <p><b>Main Office:</b> 123 Elm St. New York City, NY</p>
                                <p><b>Phone:</b> 1.555.555.5555</p>
                                <p><b>Email:</b> info@yourdomain.com</p>
                            </div>
                            <div class="social-media">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook bg-primary"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter bg-primary"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin bg-primary"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 wow fadeInRight animated">
                        <form action="" method="POST" class="contact-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" placeholder="Your Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="website" placeholder="Website URL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <textarea class="form-control" cols="30" rows="5" placeholder="Your Message..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <input type="submit" class="contact-submit" value="Send" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>Shared by <i class="fa fa-love"></i> <a href="https://bootstrapthemes.co">BootstrapThemes</a></p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JQUERY -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7Uw2EC9CJDs5vyp6EzgEmn6iVw97x3c7h79tfswKYw/rlTL" crossorigin="anonymous"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/style.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
    </body>
    </body>
</html>
