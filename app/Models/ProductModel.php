<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'brands'; // Update to match the migration table
   
    // Specify fillable fields for mass assignment
    protected $fillable = [
        'brand',
        
    ];

    public static function BrandAdd($request)
    {
        // Use mass assignment for clean code
        ProductModel::create([
            'brand' => $request->brand,
        
        ]);
    }


}
