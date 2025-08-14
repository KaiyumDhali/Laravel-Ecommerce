<?php
namespace App\Http\Controllers;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $cartItems = session()->get('cart', []);
        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        return view('checkout', compact('cartTotal','cartItems'));
    }

   

    public function processCheckout(Request $request)
{
    
    // Validate the request (uncomment if needed)
    // $validated = $request->validate([
    //     'user_id' => 'required|exists:users,id',
    //     'products' => 'required|array',
    //     'products.*.quantity' => 'required|integer|min:1',
    //     'products.*.price' => 'required|numeric|min:0',
    // ]);

    // Calculate total amount
    $totalAmount = collect($request->products)->sum(function ($product) {
        return $product['quantity'] * $product['price'];
    });

    // Create the order
    $order = Order::create([
        'user_id' => $request->user_id,
        'user_name' => $request->user_name,
        'City' => $request->City,
        'full_address' => $request->full_address,
        'user_email' => $request->user_email,
        'user_phone' => $request->user_phone,
        'total_amount' => $totalAmount,
        'payment_method' => $request->payment_method,
        'status' => 'pending',
    ]);

    // Create order details
    foreach ($request->products as $product) {
   // Find the product in the database by its ID
   $productModel = Product::find($product['id']);

   // If product exists, update its sales_count by the ordered quantity
   if ($productModel) {
       $productModel->increment('sales_count', $product['quantity']);
   }
        
   
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product['id'],  // You can replace this with the actual product ID if available
            'name' => $product['name'],
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'image'      => $product['image'] ?? null,
        ]);

    }


    // Clear the cart (assuming the cart is stored in the session)
    session()->forget('cart'); // or session()->put('cart', []); if you want to reset it

    // Return the response
    // return response()->json([
    //     'redirectUrl' => route('checkout.print', ['id' => $order->id])
    // ]);
    return response()->json(['success' => true, 'message' => 'Order status updated successfully.']);
}


    public function index()
    {
        // Retrieve all orders with related order details and user info
        $orders = Order::with('orderDetails', 'user')->get();

        return view('admin.Orders.index', compact('orders'));
    }

    public function orderConfirmation($orderId)
{
    $order = Order::with('orderDetails')->findOrFail($orderId);

    return view('confirmation', compact('order'));
}


public function updateStatus(Request $request, $id)
{
    $order = Order::find($id);

    if ($order) {
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
}





public function printOrder($id)
{
    $order = Order::findOrFail($id); // Get the order by ID
    return view('admin.print', compact('order')); // Pass the order data to the print view
}


public function generateInvoice($orderId)
    {
        // // Fetch the order and its details
        // $order = Order::with('orderDetails')->findOrFail($orderId);

        // // Pass data to the view
        // return view('invoice', compact('order'));

        $order = Order::with('orderDetails')->findOrFail($orderId);

    // Render the invoice HTML content
    $html = view('invoice', compact('order'))->render();

    // Add JavaScript to auto-trigger the print dialog
    $html .= <<<HTML
    <script>
        window.onload = function() {
            window.print(); // Trigger the print dialog
            setTimeout(function() {
                window.close(); // Attempt to close after printing
            }, 100); // Small delay to allow printing to start
        };
    </script>
    HTML;

    // Return the HTML directly
    return response($html)
        ->header('Content-Type', 'text/html');
    }


    

}
