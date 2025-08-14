@extends('layout.app')

@section('title', 'My Account')

@section('content')
<section class="account-section py-5">
    <div class="container">
        <h1 class="text-center mb-4 display-4 text-uppercase">My Account</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card premium-card shadow-lg border-0">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Account Information</h2>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-muted">Full Name</h5>
                                <p class="font-weight-bold">{{ $userName }} {{ $userLastName }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-muted">Email</h5>
                                <p class="font-weight-bold">{{ $userEmail }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-muted">Phone</h5>
                                <p class="font-weight-bold">{{ $userPhone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-muted">Address</h5>
                                <p class="font-weight-bold">{{ $userAddress }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6" style="padding-top:20px;padding-bottom:100px;">
                                <a href="{{route('user.update.view')}}" class="btn btn-outline-primary btn-lg btn-block rounded-pill">Edit Account</a>
                            </div>
                            <div class="col-md-6">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Section Styling */
    .account-section {
        background-color: #f4f6f9;
    }

    /* Premium Card Styling */
    .premium-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
        
    }

    /* Typography */
    h1 {
        letter-spacing: 3px;
        font-weight: 700;
        color: #2c3e50;
    }
    .card-title {
        font-size: 24px;
        font-weight: 600;
        color: #34495e;
    }
    .text-muted {
        font-size: 14px;
        color: #95a5a6;
    }
    .font-weight-bold {
        font-size: 16px;
        color: #2c3e50;
    }

    /* Button Styling */
    .btn-outline-primary, .btn-outline-secondary {
        border: 2px solid;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
        padding: 10px 20px;
    }
    /* Button Styling */
.btn-outline-primary {
    border-color: #F65421;
    color: #F65421;
}
.btn-outline-primary:hover {
    background-color: #F65421;
    color: white;
}
    .btn-outline-secondary {
        border-color: #95a5a6;
        color: #95a5a6;
    }
    .btn-outline-secondary:hover {
        background-color: #95a5a6;
        color: white;
    }

    /* General Card Body Padding */
    .card-body {
        padding: 50px;
    }

    /* Responsive Breakpoint Styling */
    @media (max-width: 768px) {
        .card-body {
            padding: 30px;
        }
        .btn-lg {
            font-size: 14px;
            padding: 10px 15px;
        }
    }
</style>
@endsection
