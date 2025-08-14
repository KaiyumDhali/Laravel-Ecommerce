@extends('admin.layout.app')

@section('title', 'Product List')

@section('content')

<main>
    <div class="page-content">
        <div class="container-xxl">
            <section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6">
                    <div class="card shadow-lg rounded-4 border-0">
                        <div class="card-header bg-light text-white text-center">
                        <h4 class="mb-0">Create New Category</h4>
                        </div>
                        <div class="card-body p-5">
                          

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Form Start --}}
                            <form method="POST" action="{{ route('add.category') }}">
                                @csrf

                                {{-- Category Name --}}
                                <div class="mb-4 col-md-9">
                                    <label for="category" class="form-label fw-semibold">Category Name</label>
                                    <input type="text" name="category" id="category" class="form-control" placeholder="Enter category name" required>
                                </div>

                                {{-- Subcategory Checkbox --}}
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="is_subcategory" name="is_subcategory" onclick="toggleSelectBox(this)">
                                    <label class="form-check-label" for="is_subcategory">Set as Subcategory</label>
                                </div>

                                {{-- Parent Category Dropdown --}}
                                <div class="mb-4" id="parentCategoryDiv" hidden>
                                    <label for="selectBox" class="form-label fw-semibold">Parent Category</label>
                                    <select id="selectBox" name="parent_category" class="form-select ">
                                        <option value="">-- Select Parent Category --</option>
                                        @foreach($categories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                             {{-- Submit Button --}}
                            <div class="d-flex justify-content-end gap-2 col-md-9 text-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                            </form>
                            {{-- Form End --}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    function toggleSelectBox(checkbox) {
        const parentDiv = document.getElementById('parentCategoryDiv');
        parentDiv.hidden = !checkbox.checked;
    }
</script>

@endsection
