
@extends('layout.app')
@section('title' ,'loin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to bottom, #f5f7fa, #e2e4e9);
        color: #444;
    }
    .form-container {
        max-width: 750px;
        margin: 3rem auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
    }
    .form-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-align: center;
        color: #37474f;
        position: relative;
        z-index: 1;
    }
    .form-container::before {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(55, 71, 79, 0.7), rgba(0, 128, 128, 0.3));
        z-index: 0;
        opacity: 0.1;
    }
    .form-container h1, .form-container label, .alert {
        position: relative;
        z-index: 1;
    }
    .form-container label {
        font-weight: 600;
        color: #37474f;
    }
    .form-control {
        border: none;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        font-size: 1.5rem; /* Reduced for better responsiveness */
        background-color: #f9f9f9;
        color: #37474f;
        height:55px;
    }
    .form-control:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
    }
    .btn-primary {
        background: linear-gradient(to right, #00bcd4, #009688);
        border: none;
        font-weight: 600;
        font-size: 1.7rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: background 0.3s ease;
        height:50px;
    }
    .btn-primary:hover {
        background: linear-gradient(to right, #009688, #00796b);
        color: #ffffff;
    }
    .alert {
        background-color: #e0f7fa;
        color: #00796b;
        font-weight: 500;
        border-radius: 8px;
        margin-top: 1rem;
        padding: 0.75rem 1rem;
    }
    /* Media Queries for responsiveness */
    @media (max-width: 768px) {
        .form-title {
            font-size: 1.5rem; /* Adjust title size for smaller screens */
        }
        .form-control {
            font-size: 0.9rem; /* Adjust input font size */
        }
        .btn-primary {
            font-size: 1rem; /* Adjust button font size */
        }
    }
</style>

<main>
    <section>
        <div class="container">
            <div class="form-container">
                <h1 class="form-title">Login Form</h1>
                <form method="POST" action="{{ route('log.send') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="col-md-3 lebel">Email</label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="password" class="col-md-3 lebel">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Save</button>

                    <!-- Signup Link -->
                    <a href="{{ route('user.registration') }}" class="d-block text-center mt-3" style="font-size: 1.5rem;">Signup</a>
                </form>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection