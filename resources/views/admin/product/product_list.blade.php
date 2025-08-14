@extends('admin.layout.app')

@section('title', 'Product List')

@section('content')

<main>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">All Product List</h4>

                            <a href="{{route('product.add')}}" class="btn btn-sm btn-primary">
                                Add Product
                            </a>

                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter Options
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#!" class="dropdown-item">Download</a>
                                    <a href="#!" class="dropdown-item">Export</a>
                                    <a href="#!" class="dropdown-item">Import</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Product Name & Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Rating</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset($product->image ?: 'assets/images/default.png') }}" alt="{{ $product->name }}" class="avatar-md">
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark fw-medium fs-15">{{ $product->name }}</a>
                                                    <p class="text-muted mb-0 mt-1 fs-13">
                                                        <span>Size: </span> {{ $product->size ?: 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <p class="mb-1 text-muted">
                                                <span class="text-dark fw-medium">{{ $product->quantity }} Items</span> Left
                                            </p>
                                        </td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge p-1 bg-light text-dark fs-12">
                                                <i class="bx bxs-star align-text-top fs-14 text-warning"></i> 4.5
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-light btn-sm">
                                                    <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-soft-primary btn-sm">
                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-soft-danger btn-sm">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer border-top">
                            <nav>
                                <ul class="pagination justify-content-end mb-0">
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection
