@extends('layout.app')
@section('title' ,'loin')

@section('content')

<main>
    <section>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-10">
                    <div class="card">
                    <div class="card-body txt-txt">
                    <form method="POST" action="{{ route('user.register') }}">
    @csrf
    <div style="text-align: center;">
        <h1>Registration Form</h1>
    </div>


    <!-- Display success message -->
@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

    <div>
        <div class="col-md-3 lebel">
            <label>First Name</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="text" name="f_name" placeholder="First Name" value="{{ old('f_name') }}">
            @error('f_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3 lebel">
            <label>Last Name</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="text" name="l_name" placeholder="Last Name" value="{{ old('l_name') }}">
            @error('l_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3 lebel">
            <label>Address</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="text" name="address" placeholder="Address" value="{{ old('address') }}">
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3 lebel">
            <label>Phone</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="text" name="phone" placeholder="Mobile Number" value="{{ old('phone') }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        
        

        <div class="col-md-3 lebel">
            <label>Email</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3 lebel">
            <label>Password</label>
        </div>
        <div class="col-md-9">
            <input class="input-f" type="password" name="password" placeholder="Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-4">
       
        <div class="col-md-9">
            <input class="input-f" type="text" name="status" placeholder="status" value="0" hidden>
        </div>
        </div>

         <!-- reCAPTCHA Widget -->
    
        <div class="col-md-4">
            <button style="font-size: 18px; margin-bottom: 50px; background-color: #33ffda; width:60%; height:40px; border-radius:5px; border:none;">
                Save
            </button>
        </div>

        <a href="{{route('login.log')}}"><p>Already Have an account</p></a>

        
    </div>
</form>
                    </div>
                    </div>
                    </div>

                    <div class="col-md-1">

                    </div>
                </div>

            </div>

        </div>
    </section>
</main>




@endsection