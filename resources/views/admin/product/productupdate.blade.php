
@extends('admin.layout.app')

@section('title', 'Product List')

<script>
    function toggleSelectBox2(checkbox) {
        const selectBox = document.getElementById('selectBox3');
        selectBox.hidden = !checkbox.checked;
    }

    function toggleSelectBox1(checkbox) {
        const selectBox = document.getElementById('selectBox1');
        selectBox.hidden = !checkbox.checked;
    }
</script>

@section('content')

<main>
<div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         

                        <div class="col-xl-12 col-lg-12 ">
                         <div>
                            
                            @if (session('success'))
                                <div class="alert alert-success mt-3 mx-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                          <div class="row">
                              <div class="card col-xl-6 col-lg-6">
                                   <!-- Display success message -->
                                    @if (session('success'))
                                        <div class="alert alert-success mt-3 mx-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                   <div class="card-header">
                                        <h4 class="card-title">Add Product Photo</h4>
                                   </div>
                                   <div class="card-body ">
                                        <!-- File Upload -->
                                       
                                        <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" style="width:180px;height:168px;" alt="{{ $product->image }}">
                                            <label for="image" class="form-label">Product Image</label>
                                            <input type="file" class="form-control" id="image" name="image" >
                                            @error('image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            
                                                    
                                    </div>
                                    
                                   </div>

                                   <div class="card col-xl-6 col-lg-6">
                                   <!-- Display success message -->
                                    @if (session('success'))
                                        <div class="alert alert-success mt-3 mx-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                   <div class="card-header">
                                        <h4 class="card-title">Add Product Gallery Photo</h4>
                                   </div>
                                   <div class="card-body ">
                                   @php
                                        $galleryImages = json_decode($product->gallery, true); // Decode JSON to array
                                        @endphp

                                        @if (!empty($galleryImages) && is_array($galleryImages))
                                        <div class="row">
                                             @foreach ($galleryImages as $image)
                                                  <div class="col-md-3 col-sm-4 col-6 text-center">
                                                       <div class="gallery-image">
                                                            <img src="{{ asset($image) }}" alt="Gallery Image" class="img-thumbnail" style="width: 100%; height: 180px; object-fit: cover;">
                                                            <div class="form-check mt-2">
                                                            <input type="checkbox" class="form-check-input" name="remove_images[]" value="{{ $image }}">
                                                            <label class="form-check-label">Remove</label>
                                                            </div>
                                                       </div>
                                                  </div>
                                             @endforeach
                                        </div>
                                        @endif

                                  

                                            <label for="gallery" class="form-label">Product Gallery</label>
                                            <div id="galleryContainer" class="d-flex flex-wrap gap-3">
                                                <!-- Dynamic image inputs will appear here -->
                                            </div>
                                            <button type="button" class="btn btn-secondary mt-3" onclick="addImageInput()">
                                                Add Image
                                            </button>
                                            @error('gallery.*')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                                    
                                    </div>
                                    
                                   </div>
                                   </div>
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Product Information</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-6">
                                                
                                                       <div class="mb-3">
                                                            <label for="product-name" class="form-label">Product Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ old('name', $product->name) }}">
                                                       </div>
                                                       @error('name')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                             
                                             </div>
                                             <div class="col-lg-2">
                                                  
                                                       <label for="product-categories" class="form-label">Product Categories</label>
                                                       <select id="category" name="category" class="form-select">
                                                            <option value="">--Select Category--</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                             </div>

                                             
                                                  <div class="col-lg-2">
                                                  
                                                            <div class="mb-3">
                                                            <label for="product-categories" class="form-label">Product Brand</label>
                                                            <select id="brand" name="brand" class="form-select">
                                                                <option value="">--Select Brand--</option>
                                                                @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand }}</option>
                                                                @endforeach
                                                            </select>

                                                       @error('brand')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                       @enderror
                                                            </div>
                                                  
                                                  </div>
                                                  <div class="col-lg-2">
                                                       
                                                            <div class="mb-3">
                                                            <label for="product-categories" class="form-label">Product Unit</label>
                                                            <select id="unit" name="unit" class="form-select">
                                        
                                                                 <option value="">--Select Unit--</option>
                                                                 @foreach($units as $unit)
                                                                 <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit }}</option>
                                                                 @endforeach
                                                            </select>
                                                            @error('unit')
                                                                 <div class="text-danger mt-2">{{ $message }}</div>
                                                            @enderror
                                                            </div>
                                                       
                                                  </div>
                                             
                                   
                                        </div>
                                        
                                        <div class="row mb-4">
                                             <div class="col-lg-6">
                                                  <div class="mt-3">
                                                       <h5 class="text-dark fw-medium">Size :</h5>
                                                       <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                       <label class="form-label">
                                                            <input type="checkbox" id="checkboxSize" onclick="toggleSelectBox1(this)" {{ $product->size_id ? 'checked' : '' }}> Product Size
                                                        </label>
                                                        <select id="selectBox1" name="size" class="form-select" {{ $product->size_id ? '' : 'hidden' }}>
                                                            <option value="">--Select Size--</option>
                                                            @foreach($sizes as $size)
                                                            <option value="{{ $size->id }}" {{ $product->size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                                            @endforeach
                                                        </select>


                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mt-3">
                                                       <h5 class="text-dark fw-medium">Colors :</h5>
                                                       <label class="form-label">
                                                            <input type="checkbox" id="checkboxColor" onclick="toggleSelectBox2(this)" {{ $product->color_id ? 'checked' : '' }}> Product Color
                                                        </label>
                                                        <select id="selectBox3" name="color" class="form-select" {{ $product->color_id ? '' : 'hidden' }}>
                                                            <option value="">--Select Color--</option>
                                                            @foreach($colors as $color)
                                                            <option value="{{ $color->id }}" {{ $product->color_id == $color->id ? 'selected' : '' }}>{{ $color->color }}</option>
                                                            @endforeach
                                                        </select>

                                                       </div>
                                                  </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                  <label for="description">Product Description</label>
                                                  <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                                                  
                                                  </div>
                                             </div>
                                        
                                            <div class="col-lg-3">
                                                 
                                                       <div class="mb-3">
                                                            <label for="product-id" class="form-label">Tag Number</label>
                                                            <input type="text" class="form-control" id="p_code" name="p_code" placeholder="Enter product code" value="{{ old('p_code', $product->p_code) }}">
                                                       </div>

                                                  
                                             </div>

                                             <div class="col-lg-3">
                                               
                                                       <div class="mb-3">
                                                            <label for="product-stock" class="form-label">Stock</label>
                                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter product quantity" value="{{ old('quantity', $product->quantity) }}">
                                                       </div>

                                                       @error('quantity')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                             </div>
                                             
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Pricing Details</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-4">
                                                  
                                                       <label for="product-price" class="form-label">Price</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" value="{{ old('price', $product->price) }}" step="0.01">
                                                       </div>
                                                  
                                             </div>
                                             <div class="col-lg-4">
                                                
                                                       <label for="product-discount" class="form-label">Discount</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                                            <input type="number" id="product-discount" class="form-control" name="discount" placeholder="000" value="{{ old('discount', $product->discount) }}" >
                                                       </div>
                                                 
                                             </div>
                                             <div class="col-lg-4">
                                                 
                                                       <label for="product-tex" class="form-label">Tex</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20"><i class='bx bxs-file-txt'></i></span>
                                                            <input type="number" id="product-tax" class="form-control" name="tax" placeholder="000" value="{{ old('tax', $product->tax) }}" >
                                                       </div>
                                                  
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="p-3 bg-light mb-3 rounded">
                                   <div class="row justify-content-end g-2">
                                        <div class="col-lg-2">
                                        <button type="submit" class="btn btn-outline-secondary btn-success w-100 text-white">Create</button>
                                        </div>
                                        <div class="col-lg-2">
                                             <a href="#!" class="btn btn-primary w-100">Cancel</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         </form>
                    </div>
               </div>
               <!-- End Container Fluid -->
               </main>


               <script>
    function addDropdown(targetId, placeholder, options) {
        const container = document.getElementById(targetId);
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-2');

        newRow.innerHTML = `
            <div class="col-md-6">
                <select class="form-select" name="${targetId}[]" required>
                    <option value="">--Select ${placeholder}--</option>
                    ${options}
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeRow(button) {
        button.closest('.row').remove();
    }
    let imageInputCount = 0;

    function addImageInput() {
    const container = document.getElementById('galleryContainer');
    const div = document.createElement('div');
    div.classList.add('gallery-image', 'position-relative');
    div.innerHTML = `
        <input type="file" name="gallery[]" class="form-control" onchange="previewImage(this)" required>
        <img src="#" alt="Preview" class="img-thumbnail mt-2 d-none" style="width: 100px; height: 100px;">
        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 mt-2 me-2" onclick="removeImageInput(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}

function previewImage(input) {
    const file = input.files[0];
    const img = input.nextElementSibling;
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
}


    function removeImageInput(button) {
        button.closest('.gallery-image').remove();
    }
</script>
@endsection