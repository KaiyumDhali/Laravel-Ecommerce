@extends('layout.app')
@section('title' ,'Login')

@section('content')

<!-- Bootstrap 5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-GN5oMI43y8KZ8Iq8ETxGdF/7Q9PTh9odlPSRxeb9YEXcLjUJnSoFbRpAZfoUQl5g" 
      crossorigin="anonymous">

<style>
    body {
        background: linear-gradient(to right, #e0f7fa, #f5f7fa);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        width: 420px; /* fixed width */
        background: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.2);
        position: relative;
    }
    .login-title {
        font-size: 28px;
        font-weight: 700;
        color: #37474f;
        text-align: center;
        margin-bottom: 25px;
    }
    .form-label {
        font-weight: 600;
        color: #37474f;
        margin-bottom: 8px;
    }
    .form-control {
        height: 50px;
        font-size: 16px;
        border-radius: 8px;
        padding: 10px 15px;
    }
    .form-control:focus {
        border-color: #009688;
        box-shadow: 0 0 8px rgba(0,150,136,0.4);
    }
    .btn-login {
        background: linear-gradient(to right, #00bcd4, #009688);
        border: none;
        border-radius: 8px;
        height: 50px;
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        transition: 0.3s;
        margin-top: 15px;
    }
    .btn-login:hover {
        background: linear-gradient(to right, #009688, #00695c);
    }
    .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 15px;
    }
    .signup-link a {
        text-decoration: none;
        font-weight: 600;
        color: #009688;
    }
    .signup-link a:hover {
        text-decoration: underline;
    }
</style>

<main class="login-wrapper">
    <div class="login-card">
        <h2 class="login-title">Login</h2>

        <form method="POST" action="{{ route('log.send') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       placeholder="Enter your email" 
                       value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="Enter your password">
                @error('password')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-login w-100">Login</button>

            <!-- Signup -->
            <div class="signup-link">
                Don’t have an account? 
                <a href="{{ route('user.registration') }}">Signup</a>
            </div>
        </form>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ppYN7FXGe3tGgfQ/HVbUaz2YsmiVjCwXTlzAIXazhbugzuDUFc1l1b/HY70dNFu7" 
        crossorigin="anonymous"></script>

@endsection
