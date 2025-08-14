{{-- resources/views/admin/news/index.blade.php --}}
@extends('admin.layout.app')

@section('content')
<main class="page-content">
<div class="container mt-4">
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Add News</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Created At</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" width="100">
                    @endif
                </td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this news?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $news->links() }}
</div>
</main>
@endsection
