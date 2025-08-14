<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
class PurchaseController extends Controller
{
    public function index(){
         $suppliers = Supplier::all();
        // $products = Product::where('is_purchaseable', true)->get();
        $products = Product::with('colors', 'sizes')->get();
    // dd($products);
        return view('admin.purchase.index', compact('products','suppliers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'products.*.id' => 'required|exists:products,id',
            'products.*.price' => 'required|numeric',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.total' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0',
            'grand_total' => 'required|numeric',
        ]);

        // Create purchase
        $purchase = Purchase::create([
            'purchase_date' => $request->purchase_date,
            'supplier_id' => $request->supplier_id,
            'discount' => $request->discount ?? 0,
            'grand_total' => $request->grand_total,
        ]);

        // Attach products
        foreach ($request->products as $product) {
            if (!empty($product['id'])) {
                $purchase->products()->create([
                    'product_id' => $product['id'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'color' => $product['color'] ?? null,
                    'size' => $product['size'] ?? null,
                    'total' => $product['total'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Purchase saved successfully!');
    }
    

    public function listview()
    {
        $purchaseProducts = PurchaseProduct::with(['purchase.supplier', 'product'])->latest()->get();

        return view('admin.purchase.list', compact('purchaseProducts'));
    }
}
