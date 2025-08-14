<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
        ]);

        // Save the category to the database
        Category::create([
            'name' => $request->input('category'),
            'is_subcategory' => $request->has('is_subcategory'),
            'parent_category' => $request->input('parent_category')
        ]);

        // Redirect back with success message
        return redirect('/categoryadd')->with('success', 'Category saved successfully!');
    }
}
