@extends('admin.layout.app')
@section('title', 'Purchase Product')

@section('content')
<main class="page-content">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-7xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-xl border">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        🛒 Purchase Product
    </h2>

    <form id="purchaseForm" action="{{ route('purchase.store.post') }}" method="POST">
        @csrf

        <!-- Top Info: Purchase Date & Supplier -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Purchase Date</label>
                <input type="date" name="purchase_date" class="w-full h-12 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 shadow-sm" required>
            </div>
           <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                <select name="supplier_id" class="w-full h-12 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 shadow-sm" required>
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Product Selection -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Select Product</label>
            <select id="productSelect" name="products[0][id]" class="w-full h-12 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 shadow-sm">
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option 
                        value="{{ $product->id }}" 
                        data-price="{{ $product->price }}"
                        data-colors='@json($product->colors->pluck("name"))'
                        data-sizes='@json($product->sizes->pluck("name"))'>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Product Details: Price, Qty, Color, Size, Total -->
        <div class="grid md:grid-cols-5 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (৳)</label>
                <input type="number" id="productPrice" name="products[0][price]" class="w-full h-12 rounded-lg border-gray-300 shadow-sm px-3" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" id="productQty" name="products[0][quantity]" value="1" min="1" class="w-full h-12 rounded-lg border-gray-300 shadow-sm px-3">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                <input type="text" id="productColor" name="products[0][color]" class="w-full h-12 rounded-lg border-gray-300 shadow-sm bg-gray-100 px-3" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                <input type="text" id="productSize" name="products[0][size]" class="w-full h-12 rounded-lg border-gray-300 shadow-sm bg-gray-100 px-3" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total (৳)</label>
                <input type="number" id="productTotal" name="products[0][total]" class="w-full h-12 rounded-lg border-gray-300 shadow-sm bg-gray-100 px-3" readonly>
            </div>
        </div>

        <!-- Discount & Grand Total -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Discount (৳)</label>
                <input type="number" id="discount" name="discount" value="0" min="0" class="w-full h-12 rounded-lg border-gray-300 shadow-sm px-3">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Grand Total (৳)</label>
                <input type="number" id="grandTotal" name="grand_total" class="w-full h-12 rounded-lg border-gray-300 shadow-sm bg-gray-100 px-3" readonly>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-6">
    <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold h-12 rounded-lg shadow-md transition px-6">
        ✅ Confirm Purchase
    </button>
       </div>

    </form>
</div>

<script>
const productSelect = document.getElementById('productSelect');
const productPrice = document.getElementById('productPrice');
const productQty = document.getElementById('productQty');
const productColor = document.getElementById('productColor');
const productSize = document.getElementById('productSize');
const productTotal = document.getElementById('productTotal');
const discount = document.getElementById('discount');
const grandTotal = document.getElementById('grandTotal');

function updateProductDetails() {
    const option = productSelect.options[productSelect.selectedIndex];
    const price = parseFloat(option.dataset.price || 0);
    const colors = JSON.parse(option.dataset.colors || "[]");
    const sizes = JSON.parse(option.dataset.sizes || "[]");

    productPrice.value = price.toFixed(2);
    productQty.value = 1;
    productColor.value = colors.join(', ') || '';
    productSize.value = sizes.join(', ') || '';

    calculateTotal();
}

function calculateTotal() {
    const total = (parseFloat(productPrice.value) || 0) * (parseInt(productQty.value) || 0);
    const disc = parseFloat(discount.value) || 0;
    productTotal.value = total.toFixed(2);
    grandTotal.value = (total - disc).toFixed(2);
}

productSelect.addEventListener('change', updateProductDetails);
productQty.addEventListener('input', calculateTotal);
discount.addEventListener('input', calculateTotal);
</script>

@endsection
