{{-- resources/views/admin/news/edit.blade.php --}}
@extends('admin.layout.app')

@section('content')
<main class="page-content">
<div class="container mt-4">
    <h2>Edit News</h2>
    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $news->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $news->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" width="120" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
</main>
@endsection
