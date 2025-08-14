@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')
<div class="bg-gray-50 min-h-screen py-6 page-content ">
    <div class="container mx-auto">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- PRODUCT PHOTOS --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                <h5 class="text-lg font-semibold text-gray-700">Product Images</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Main Image --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Main Product Image</label>
                        <input type="file" name="image" onchange="previewMainImage(this)"
                               class="h-12 px-2 pt-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('image')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <img id="mainPreview" class="mt-2 hidden w-28 h-28 object-cover rounded-md border">
                    </div>

                    {{-- Gallery Images --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Gallery Images</label>
                        <div id="galleryContainer" class="flex flex-wrap gap-3"></div>
                        <button type="button" onclick="addImageInput()"
                                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            + Add Gallery Image
                        </button>
                        @error('gallery.*')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- PRODUCT DETAILS --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                <h5 class="text-lg font-semibold text-gray-700">Product Details</h5>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" name="name" placeholder="Product Name"
                               value="{{ old('name') }}"
                               class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <select name="category"
                                class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            <option value="">-- Category --</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <select name="brand"
                                class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            <option value="">-- Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                            @endforeach
                        </select>
                        @error('brand') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <select name="unit"
                                class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            <option value="">-- Unit --</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                            @endforeach
                        </select>
                        @error('unit') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- SIZE & COLOR --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                <h5 class="text-lg font-semibold text-gray-700">Variants</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sizes</label>
                        <div id="sizesContainer"></div>
                        <button type="button" onclick="addDropdown('sizesContainer', 'Size', `@foreach($sizes as $size)<option value='{{ $size->id }}'>{{ $size->size }}</option>@endforeach`)"
                                class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            + Add Size
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Colors</label>
                        <div id="colorsContainer"></div>
                        <button type="button" onclick="addDropdown('colorsContainer', 'Color', `@foreach($colors as $color)<option value='{{ $color->id }}'>{{ $color->color }}</option>@endforeach`)"
                                class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            + Add Color
                        </button>
                    </div>
                </div>
            </div>

            {{-- DESCRIPTION & STOCK --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                <h5 class="text-lg font-semibold text-gray-700">Additional Info</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <textarea name="description" placeholder="Description" rows="3"
                              class="px-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('description') }}</textarea>
                    <input type="text" name="p_code" placeholder="#******"
                           class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="Stock"
                           class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('quantity') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- PRICING --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                <h5 class="text-lg font-semibold text-gray-700">Pricing</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="number" name="price" step="0.01" placeholder="Price"
                           class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <input type="number" name="discount" placeholder="Discount"
                           class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <input type="number" name="tax" placeholder="Tax"
                           class="h-12 px-4 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex justify-end gap-4">
                <button type="submit"
                        class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    Create
                </button>
                <a href="#"
                   class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

{{-- JS --}}
<script>
    function addDropdown(targetId, placeholder, options) {
        const container = document.getElementById(targetId);
        const div = document.createElement('div');
        div.classList.add('flex', 'gap-2', 'mb-2');
        div.innerHTML = `
            <select class="h-12 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400" name="${targetId}[]" required>
                <option value="">--Select ${placeholder}--</option>
                ${options}
            </select>
            <button type="button" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="this.parentElement.remove()">Remove</button>
        `;
        container.appendChild(div);
    }

    function previewMainImage(input) {
        const file = input.files[0];
        const img = document.getElementById('mainPreview');
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function addImageInput() {
        const container = document.getElementById('galleryContainer');
        const div = document.createElement('div');
        div.classList.add('relative');
        div.innerHTML = `
            <input type="file" name="gallery[]" class="h-12 px-2 pt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400" onchange="previewGalleryImage(this)">
            <img class="mt-2 hidden w-24  h-24 object-cover rounded-md border">
            <button type="button" class="absolute  top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition" onclick="this.parentElement.remove()">×</button>
        `;
        container.appendChild(div);
    }

    function previewGalleryImage(input) {
        const file = input.files[0];
        const img = input.nextElementSibling;
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
