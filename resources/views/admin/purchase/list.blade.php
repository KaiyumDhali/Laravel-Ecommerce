@extends('admin.layout.app')
@section('title', 'Purchase Product List')

@section('content')
<main class="page-content">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-xl border">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        📦 Purchase Product List
    </h2>

    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-3 px-4 border-b">#</th>
                <th class="py-3 px-4 border-b">Purchase Date</th>
                <th class="py-3 px-4 border-b">Supplier</th>
                <th class="py-3 px-4 border-b">Product</th>
                <th class="py-3 px-4 border-b">Price (৳)</th>
                <th class="py-3 px-4 border-b">Quantity</th>
                <th class="py-3 px-4 border-b">Color</th>
                <th class="py-3 px-4 border-b">Size</th>
                <th class="py-3 px-4 border-b">Total (৳)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchaseProducts as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->purchase->purchase_date ?? '-' }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->purchase->supplier->name ?? '-' }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->product->name ?? '-' }}</td>
                    <td class="py-3 px-4 border-b">{{ number_format($item->price, 2) }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->quantity }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->color ?? '-' }}</td>
                    <td class="py-3 px-4 border-b">{{ $item->size ?? '-' }}</td>
                    <td class="py-3 px-4 border-b font-semibold text-green-600">{{ number_format($item->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-gray-500">No purchase products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
