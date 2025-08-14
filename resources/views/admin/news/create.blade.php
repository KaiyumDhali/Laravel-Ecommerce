{{-- resources/views/admin/news/create.blade.php --}}
@extends('admin.layout.app')

@section('content')
<main class="page-content">
<div class="container mt-4">
    <h2>Add News</h2>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
</main>
@endsection
