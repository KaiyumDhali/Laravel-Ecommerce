@extends('admin.layout.app')

@section('title', 'Add Partner')

@section('content')
<main class="page-content">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4">Add New Partner</h4>

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Partner Name</label>
                        <input type="text" 
                               class="form-control" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter partner name">
                    </div>

                    {{-- Link --}}
                    <div class="mb-3">
                        <label for="link" class="form-label">Partner Link</label>
                        <input type="text" 
                               class="form-control" 
                               name="link" 
                               id="link" 
                               value="{{ old('link') }}" 
                               placeholder="https://example.com">
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Partner Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    {{-- Submit --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Save</button>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
