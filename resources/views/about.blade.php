@extends('layout.app')

@section('title', 'About Us')

@section('content')

<section class="about-container">
    <!-- Company Header -->
    <section class="company-header text-center">
        <div class="container">
            <h1 class="page-header">About Our Company</h1>
            <p style="margin-top:20px; margin-bottom:100px;">Welcome to <strong>{{ $company_info->company_name }}</strong>. Learn more about our mission, vision, and values.</p>
        </div>
    </section>

    <!-- Company Info -->
    <section class="company-info">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 info-block text-center">
                    <h3 class="text-primary">Our Mission</h3>
                    <p>{{ $company_info->mission }}</p>
                </div>

                <div class="col-md-4 col-sm-6 info-block text-center">
                    <h3 class="text-primary">Our Vision</h3>
                    <p>{{ $company_info->vision }}</p>
                </div>

                <div class="col-md-4 col-sm-6 info-block text-center">
                    <h3 class="text-primary">Our Values</h3>
                    <p>{{ $company_info->values }}</p>
                </div>
            </div>
        </div>
    </section>
</section>

<style>
.about-container {
    background-color: #f9f9f9;
    padding: 40px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.company-header h1 {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 15px;
    color: #222;
}

.company-header p {
    font-size: 18px;
    color: #555;
}

.info-block h3 {
    font-weight: 600;
    color: #ff6600;
    margin-bottom: 15px;
    font-size: 22px;
}

.info-block p {
    font-size: 16px;
    line-height: 1.6;
    color: #444;
}

@media (max-width: 767px) {
    .company-header h1 {
        font-size: 28px;
    }
    .info-block h3 {
        font-size: 18px;
    }
}
</style>

@endsection
