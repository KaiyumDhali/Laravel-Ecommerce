<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Order;

class AdminHomeController extends Controller
{
    public function index()
    {
      $orders = Order::with('orderDetails')->get();

        $totalorder=Order::count();
        return view('admin.index',compact('totalorder','orders'));
    }

    public function indexslider()
    {
        // Display list of sliders
        $sliders = Slider::all();
        return view('admin.slider.slider', compact('sliders'));
    }

    public function createslider()
    {
        // Show form to create a new slider
        return view('admin.slider.create');
    }

    public function storeslider(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Create a new slider entry in the database
            Slider::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => 'images/' . $imageName,
                'link' => $request->link,
            ]);
        }

        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully');
    }
}
