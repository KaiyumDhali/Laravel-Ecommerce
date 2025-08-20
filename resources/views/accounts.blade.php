@extends('layout.app')

@section('title', 'My Account')

@section('content')
<section class="account-section py-5" style="background-color: #f8f9fa; margin-bottom:50px;">
    <div class="container">
        <h1 class="text-center mb-5 display-4 text-uppercase fw-bold" style="letter-spacing: 1px;">My Account</h1>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-3 mb-5">
                    <div class="card-body p-5">
                        <h2 class="card-title mb-4 fw-bold">Account Information</h2>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">Full Name</h6>
                                <p class="fw-bold mb-0">{{ $userName }} {{ $userLastName }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">Email</h6>
                                <p class="fw-bold mb-0">{{ $userEmail }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">Phone</h6>
                                <p class="fw-bold mb-0">{{ $userPhone }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">Address</h6>
                                <p class="fw-bold mb-0">{{ $userAddress }}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('user.update.view') }}" class="btn btn-primary btn-lg rounded-pill me-3">
                                Edit Account
                            </a>
                            {{-- Add more action buttons here if needed --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
