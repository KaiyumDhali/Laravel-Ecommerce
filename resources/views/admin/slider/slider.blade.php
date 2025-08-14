@extends('admin.layout.app')
@section('title', 'Create Slider')

@section('content')
<main class="page-content">
    <div class="container-xxl mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-light text-white text-center">
                        <h4 class="mb-0">Create New Slider</h4>
                    </div>
                    <div class="card-body p-4">

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Title --}}
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{ old('title') }}" required>
                            </div>

                            {{-- Subtitle --}}
                            <div class="mb-3">
                                <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Enter subtitle" value="{{ old('subtitle') }}">
                            </div>

                            {{-- Link --}}
                            <div class="mb-3">
                                <label for="link" class="form-label fw-semibold">Link</label>
                                <input type="url" name="link" id="link" class="form-control" placeholder="Enter URL" value="{{ old('link') }}">
                            </div>

                            {{-- Image Upload --}}
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Slider Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)" required>
                                <small class="text-muted d-block mt-1">Upload a high-resolution image (Recommended: 1920x600).</small>
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail mt-3 d-none" style="max-height: 180px;">
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
            preview.src = '#';
        }
    }
</script>
@endsection
