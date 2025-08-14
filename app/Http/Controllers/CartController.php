<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class CartController extends Controller
{
    // public function addToCart($id)
    // {
    //     $product = Product::findOrFail($id);

    //     $cart = session()->get('cart', []);

    //     if(isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $product->name,
    //             'price' => $product->price,
    //             'quantity' => 1,
    //             'image' => $product->image
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product added to cart!');
    // }
    
    public function addToCart(Request $request, $id)
    {
        
        $product = Product::with(['sizes', 'colors'])->findOrFail($id);
    
        // Get the cart from session, or initialize it as an empty array
        $cart = session()->get('cart', []);
    
        // Check if the product is already in the cart
        if (isset($cart[$id])) {
            // Increase the quantity if already in the cart
            $cart[$id]['quantity']++;
        } else {
            // Otherwise, add the product with a quantity
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1), // Default to 1 if not provided
                'size'=>$request->input('size'),
                'color'=>$request->input('color'),
                'image' => $product->image,
            ];
        }
    
        // Update the session with the modified cart
        session()->put('cart', $cart);
    
        // Calculate the total price of all items in the cart
        $cartTotal = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Return a JSON response for the AJAX request
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'cartCount' => count($cart), // Updated cart count
            'cartTotal' => $cartTotal,  // Updated cart total
        ]);
    }
    


    public function viewCart()
    {
        $cartItems = session()->get('cart', []);
        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

      

        return view('cart', compact('cartItems', 'cartTotal'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
    
            // Calculate updated totals
            $itemTotal = $cart[$id]['price'] * $cart[$id]['quantity'];
            $cartTotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
    
            return response()->json([
                'success' => true,
                'itemTotal' => $itemTotal,
                'cartTotal' => $cartTotal
            ]);
        }
    
        return response()->json(['success' => false], 400);
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.view');
    }
}
