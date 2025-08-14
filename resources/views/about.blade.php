@extends('layout.app')

@section('title', 'About Us')

@section('content')

<section class="about-container">
    <section class="company-header text-center py-5">
        <h1>About Our Company</h1>
        <p>Welcome to <strong>{{ $companyInfo->company_name }}</strong>. Learn more about our mission, vision, and values.</p>
    </section>

    <section class="company-info container">
        <div class="row">
            <div class="col-md-4 info-block mb-4">
                <h2>Our Mission</h2>
                <p>{{ $companyInfo->mission }}</p>
            </div>

            <div class="col-md-4 info-block mb-4">
                <h2>Our Vision</h2>
                <p>{{ $companyInfo->vision }}</p>
            </div>

            <div class="col-md-4 info-block mb-4">
                <h2>Our Values</h2>
                <p>{{ $companyInfo->values }}</p>
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
    font-size: 2.8rem;
    margin-bottom: 0.5rem;
    color: #222;
}

.company-header p {
    font-size: 1.5rem;
    color: #555;
}

.info-block h2 {
    font-weight: 600;
    color: #ff6600ff;
    margin-bottom: 1rem;
    font-size: 1.6rem;
}

.info-block p {
    font-size: 1.2remrem;
    line-height: 1.6;
    color: #444;
}

@media (max-width: 767px) {
    .company-header h1 {
        font-size: 2rem;
    }
    .info-block h2 {
        font-size: 1.3rem;
    }
}
</style>

@endsection
