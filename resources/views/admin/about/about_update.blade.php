@extends('admin.layout.app')

@section('title', 'Edit Company Information')

@section('content')

<main class="page-content">
<div class="form-container">
    <h1 class="form-title">Edit Company Information</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

   <form action="{{ route('company-info.update') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $companyInfo->company_name) }}" required>
            @error('company_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="company_address" class="form-label"> Company Address</label>
            <input type="text" name="company_address" id="company_address" class="form-control" value="{{ old('company_address', $companyInfo->company_address) }}" required>
            @error('company_address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="mission" class="form-label">Mission</label>
            <textarea name="mission" id="mission" rows="4" class="form-control" required>{{ old('mission', $companyInfo->mission) }}</textarea>
            @error('mission')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="vision" class="form-label">Vision</label>
            <textarea name="vision" id="vision" rows="4" class="form-control" required>{{ old('vision', $companyInfo->vision) }}</textarea>
            @error('vision')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="values" class="form-label">Values</label>
            <textarea name="values" id="values" rows="4" class="form-control" required>{{ old('values', $companyInfo->values) }}</textarea>
            @error('values')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
<div class="mb-4">
    <label for="company_logo" class="form-label">Company Logo</label>
    <input type="file" name="company_logo" id="company_logo" class="form-control" >
    @error('company_logo')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    @if(!empty($companyInfo->company_logo))
        <div class="mt-2">
            <img src="{{ asset($companyInfo->company_logo) }}" alt="Company Logo" style="max-height:100px; border-radius:8px;">
        </div>
    @endif
</div>

        <button type="submit" class="btn btn-primary w-100">Update Information</button>
    </form>
</div>
</main>

@endsection

@push('styles')
<style>
    /* Your custom CSS here (you can paste your CSS from the form you gave me) */
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
    /* Decorative gradient overlay */
    .form-container::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
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
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        font-size: 1rem;
        background-color: #f9f9f9;
        color: #37474f;
    }
    .form-control:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
    }
    .btn-primary {
        background: linear-gradient(to right, #00bcd4, #009688);
        border: none;
        font-weight: 600;
        font-size: 1.2rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(to right, #009688, #00796b);
        color: #ffffff;
    }
    /* Alert styling */
    .alert {
        background-color: #e0f7fa;
        color: #00796b;
        font-weight: 500;
        border-radius: 8px;
        margin-top: 1rem;
        padding: 0.75rem 1rem;
    }
</style>
@endpush
