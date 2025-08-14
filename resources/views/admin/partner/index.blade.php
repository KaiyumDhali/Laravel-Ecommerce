@extends('admin.layout.app')

@section('title', 'Manage Partners')

@section('content')
<main class="page-content">
    <div class="container mt-4">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Partners</h1>
            <a href="{{ route('admin.partners.create') }}" class="btn btn-success">
                + Add New Partner
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $key => $partner)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($partner->image) }}" 
                                         alt="{{ $partner->name }}" 
                                         class="img-thumbnail" 
                                         style="height: 60px;">
                                </td>
                                <td>{{ $partner->name }}</td>
                                <td>
                                    <a href="{{ $partner->link }}" target="_blank">{{ $partner->link }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}" 
                                       class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this partner?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No partners found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
