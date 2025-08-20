<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductModel;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Unit;
use App\Models\CompanyInfo;


class ProductController extends Controller
{
    public function index(){

        $brands = ProductModel::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $units = Unit::all();
        


        return view('admin.product.create_product', compact('brands','categories','sizes','colors','units'));
    }

    public function showDetails($id)
{
     $categories = Category::withCount('products')->get();
    $company_info = CompanyInfo::first();
    $product = Product::with(['sizes', 'colors'])->findOrFail($id);
//dd( $product);
    // Fetch related products in the same category (excluding the current product)
    $relatedProducts = Product::with('category')
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $id)
        ->take(4)
        ->get();

    // Return the view with the product and related products
    return view('details', compact('product', 'relatedProducts','company_info','categories'));
}


public function admindetails($id)
{
    // Fetch the product with its relationships
    $product = Product::with(['sizes', 'colors'])->findOrFail($id);

    // Fetch related products in the same category (excluding the current product)
    $relatedProducts = Product::with('category')
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $id)
        ->take(4)
        ->get();

    // Return the view with the product and related products
    return view('admin.product.details', compact('product', 'relatedProducts'));
}




public function store(Request $request)
{

    // dd($request);
    // Validate incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'p_code' => 'required|string|unique:products,p_code',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'tax' => 'nullable|numeric', // Tax amount
        'quantity' => 'required|integer|min:0',
        'category' => 'required|exists:categories,id',
        'brand' => 'required|exists:brands,id',
        'unit' => 'required|exists:units,id',
        'sizesContainer' => 'nullable|array',
        'sizesContainer.*' => 'exists:sizes,id',
        'colorsContainer' => 'nullable|array',
        'colorsContainer.*' => 'exists:colors,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Calculate the final price after discount
    $discountedPrice = $validated['price'];
    if (!empty($validated['discount'])) {
        $discountedPrice -= ($validated['price'] * $validated['discount'] / 100);
    }

    // Calculate final price with tax
    $finalPrice = $discountedPrice;
    if (!empty($validated['tax'])) {
        $finalPrice += $validated['tax'];
    }

    // Create the product
    $product = Product::create([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'p_code' => $validated['p_code'],
        'price' => $validated['price'], // Original price
        'discount' => $validated['discount'] ?? 0, // Save discount
        'tax' => $validated['tax'] ?? 0, // Save tax
        'final_price' => $finalPrice, // Save final calculated price
        'quantity' => $validated['quantity'],
        'category_id' => $validated['category'],
        'brand_id' => $validated['brand'],
        'unit_id' => $validated['unit'],
        'is_featured' => $request->has('is_featured') ? 1 : 0,
    ]);

    // Attach sizes and colors if provided
    if ($request->sizesContainer) {
        $product->sizes()->attach($request->sizesContainer);
    }
    if ($request->colorsContainer) {
        $product->colors()->attach($request->colorsContainer);
    }

    // Handle main product image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = 'storage/' . $imagePath;
        $product->save();
    }

    // Handle gallery images upload
    if ($request->hasFile('gallery')) {
        $galleryPaths = [];
        foreach ($request->file('gallery') as $image) {
            $imagePath = $image->store('products/gallery', 'public');
            $galleryPaths[] = 'storage/' . $imagePath;
        }
        $product->gallery = json_encode($galleryPaths);
        $product->save();
    }

    return redirect()->back()->with('success', 'Product added successfully!');
}



    



    public function viewlist()
    {
        $products = Product::with('category', 'brand', 'unit')->get(); // Eager load related models
        return view('admin.product.product_list', compact('products'));
    }



    public function edit($id)
    {
        $product = Product::find($id); // Use find() instead of findOrFail()
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
    
        $categories = Category::all();
        $brands = ProductModel::all();
        $sizes = Size::all();
        $colors = Color::all();
        $units = Unit::all();
    
        return view('admin.product.productupdate', compact('product', 'categories', 'brands', 'sizes', 'colors', 'units'));
    }

    // Update the product
    public function update(Request $request, $id)
{

    $product = Product::findOrFail($id);
    // Validate request data
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|exists:categories,id',
        'brand' => 'nullable|exists:brands,id',
        'unit' => 'nullable|exists:units,id',
        'size' => 'nullable|exists:sizes,id',
        'color' => 'nullable|exists:colors,id',
        'p_code' => 'nullable|string|max:50',
        'quantity' => 'nullable|integer|min:0',
        'price' => 'nullable|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'tax' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'remove_images' => 'nullable|array',
    ]);

     // ✅ Handle Single Image Upload
     if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        // Upload new image
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = 'storage/' . $imagePath;
    }

    // ✅ Handle Gallery Image Uploads
    $galleryImages = json_decode($product->gallery, true) ?? [];

    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $image) {
            $path = $image->store('products/gallery', 'public');
            $galleryImages[] = 'storage/' . $path;
        }
    }

    // ✅ Remove Selected Images from Gallery
    if ($request->filled('remove_images')) {
        foreach ($request->remove_images as $removeImage) {
            if (($key = array_search($removeImage, $galleryImages)) !== false) {
                unset($galleryImages[$key]);
                Storage::delete(str_replace('storage/', '', $removeImage));
            }
        }
    }

    // ✅ Ensure gallery is a clean JSON array
    $filteredGallery = array_values(array_filter($galleryImages, 'is_string')); // Remove empty objects
    $product->gallery = json_encode($filteredGallery);

    // ✅ Update Other Product Details
    $product->name = $request->name;
    $product->category_id = $request->category;
    $product->brand_id = $request->brand;
    $product->size_id = $request->size;
    $product->color_id = $request->color;
    $product->p_code = $request->p_code;
    $product->quantity = $request->quantity;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->tax = $request->tax;
    $product->description = $request->description;

    $product->save();

    return redirect()->route('products.viewlist')->with('success', 'Product updated successfully!');
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.viewlist')->with('success', 'Product deleted successfully.');
    }




    public function destroybrand($id)
    {
        $branddlt = ProductModel::findOrFail($id);
        $branddlt->delete();
        return redirect()->route('brand.list')->with('success', 'brand deleted successfully.');
    }
    public function brandview(){

        return view('admin.brand.addbrand');
    }
    public function brandlist()
    {
        $brands = ProductModel::all();
        return view('admin.brand.brandlist',compact('brands'));
    }
    public function brandadd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|max:255',
       
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Register User
        ProductModel::BrandAdd($request);

        return redirect()->route('brand.add')->with('success', 'brand added successful!');
    }

     
    public function brandedit($id)
    {
        $brands = ProductModel::all();
        $brand = ProductModel::findOrFail($id);
        return view('admin.brand.editbrand',compact('brand','brands'));
        
    }


    public function brandupdate(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'brand' => 'required|string|max:255',
        ]);
    
        // Find the brand
        $brand = ProductModel::findOrFail($id);
    
        // Update category fields
        $brand->brand = $request->brand;
       
    
        // Save the updated brand
        $brand->save();
    
        // Redirect back with success message
        return redirect()->route('brand.list')->with('success', 'Brand updated successfully!');
    }

    public function categoryview(){

        $categories = Category::where('is_subcategory', false)->get();
        return view('admin.category.addcategory', compact('categories'));
    }


    public function categorylist()
    {
        $categories = Category::all();
        return view('admin.category.categorylist',compact('categories'));
    }

    
    public function categoryedit($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.category.categoryupdate',compact('category','categories'));
        
    }

    
    public function categoryupdate(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'category' => 'required|string|max:255',
            'is_subcategory' => 'sometimes|boolean', // Ensure it is either true (1) or false (0)
            'parent_category' => 'nullable|exists:categories,id',
        ]);
    
        // Find the category
        $category = Category::findOrFail($id);
    
        // Update category fields
        $category->name = $request->category;
        $category->is_subcategory = $request->has('is_subcategory') ? 1 : 0; // Convert checkbox value to boolean
        $category->parent_category = $request->parent_category ?? null; // Null if not selected
    
        // Save the updated category
        $category->save();
    
        // Redirect back with success message
        return redirect()->route('category.list')->with('success', 'Category updated successfully!');
    }
    public function categorydestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.list')->with('success', 'Product deleted successfully.');
    }

    public function sizelist()
    {
        $sizes = Size::all();
        return view('admin.size.sizelist',compact('sizes'));
    }
    public function sizeview()
    {

        
        return view('admin.size.size');
    }

    
    public function sizeadd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|string|max:255',
       
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Register User
        Size::addSize($request);

        return redirect()->route('size.add')->with('success', 'size added successful!');
    }
   
    public function sizeedit($id)
    {
        $sizes = Size::all();
        $size = Size::findOrFail($id);
        return view('admin.size.editsize',compact('size','sizes'));
        
    }


    public function sizeupdate(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'size' => 'required|string|max:255',
        ]);
    
        // Find the brand
        $size = Size::findOrFail($id);
    
        // Update category fields
        $size->size = $request->size;
       
    
        // Save the updated brand
        $size->save();
    
        // Redirect back with success message
        return redirect()->route('size.list')->with('success', 'size updated successfully!');
    }

    public function destroysize($id)
    {
        $sizedlt = Size::findOrFail($id);
        $sizedlt->delete();
        return redirect()->route('size.list')->with('success', 'size deleted successfully.');
    }

    public function colorlist()
    {
        $colors = Color::all();
        return view('admin.color.colorlist',compact('colors'));
    }


    public function colorview()
    {

        return view('admin.color.color');
    }

    
    public function coloradd(Request $request)
    {
        // dd($request->color);
        $validator = Validator::make($request->all(), [
            'color' => 'required|string|max:255',
       
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Register User
        Color::addColor($request);

        return redirect()->route('color.add')->with('success', 'Color added successful!');
    }




    public function coloredit($id)
    {
        $colors = Color::all();
        $color = Color::findOrFail($id);
        return view('admin.color.editcolor',compact('color','colors'));
        
    }


    public function colorupdate(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'color' => 'required|string|max:255',
        ]);
    
        // Find the brand
        $color = Color::findOrFail($id);
    
        // Update category fields
        $color->color = $request->color;
       
    
        // Save the updated brand
        $color->save();
    
        // Redirect back with success message
        return redirect()->route('color.list')->with('success', 'color updated successfully!');
    }

    public function destroycolor($id)
    {
        $colordlt = Color::findOrFail($id);
        $colordlt->delete();
        return redirect()->route('color.list')->with('success', 'color deleted successfully.');
    }


    public function unitlist()
    {
        $units = Unit::all();
        return view('admin.unit.unitlist',compact('units'));
    }

    public function unitview()
    {

        return view('admin.unit.unit');
    }

    
    public function unitadd(Request $request)
    {
        //  dd($request->unit);
        $validator = Validator::make($request->all(), [
            'unit' => 'required|string|max:255',
       
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Register User
        Unit::UnitAdd($request);

        return redirect()->route('unit.add')->with('success', 'Unit added successful!');
    }

    public function unitedit($id)
    {
        $units = Unit::all();
        $unit = Unit::findOrFail($id);
        return view('admin.unit.editunit',compact('unit','units'));
        
    }


    public function unitupdate(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'unit' => 'required|string|max:255',
        ]);
    
        // Find the brand
        $unit = Unit::findOrFail($id);
    
        // Update category fields
        $unit->unit = $request->unit;
       
    
        // Save the updated brand
        $unit->save();
    
        // Redirect back with success message
        return redirect()->route('unit.list')->with('success', 'unit updated successfully!');
    }

    public function destroyunit($id)
    {
        $unitdlt = Unit::findOrFail($id);
        $unitdlt->delete();
        return redirect()->route('unit.list')->with('success', 'unit deleted successfully.');
    }



}
