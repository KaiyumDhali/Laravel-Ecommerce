@extends('admin.layout.app')

@section('title', 'Update Category')

@section('content')

<main>
    <div class="page-content">
        <div class="container-xxl">
            <section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4">
                         <div class="card-header bg-light text-white text-center">
                        <h4 class="mb-0">Create New Category</h4>
                        </div>
                        <div class="card-body p-5">
                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if($errors->any())
                                <div class="alert alert-danger text-center">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Form Start -->
                            <form method="POST" action="{{ route('update.category', $category->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Category Name -->
                                <div class="mb-4 col-md-9">
                                    <label class="form-label fw-semibold">Category Name</label>
                                    <input type="text" name="category" class="form-control" placeholder="Enter category name" value="{{ old('category', $category->name) }}" required>
                                </div>

                                <!-- Subcategory Checkbox -->
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="is_subcategory" name="is_subcategory" value="{{$category->is_subcategory}}" onclick="toggleSelectBox(this)" {{ old('is_subcategory', $category->is_subcategory) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_subcategory">Set as Subcategory</label>
                                </div>

                                <!-- Parent Category Dropdown -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Parent Category</label>
                                    <select id="selectBox" name="parent_category" class="form-select" {{ old('is_subcategory', $category->is_subcategory) ? '' : 'hidden' }}>
                                        <option value="">-- Select Parent Category --</option>
                                        @foreach($categories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}" {{ old('parent_category', $category->parent_category_id) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                 {{-- Submit Button --}}
                            <div class="d-flex justify-content-end gap-2 col-md-9 text-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- JavaScript to Toggle Parent Category -->
<script>
    function toggleSelectBox(checkbox) {
        // Toggle the visibility of the Parent Category dropdown based on checkbox state
        document.getElementById('selectBox').hidden = !checkbox.checked;
    }
</script>

@endsection
