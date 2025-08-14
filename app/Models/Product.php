<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'p_code',
        'price',
        'discount',
        'tax',
        'final_price',
        'quantity',
        'category_id',
        'brand_id',
        'unit_id',
        'image',
        'gallery',
        'is_featured',
        'sales_count',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(ProductModel::class); // আগে ProductModel লেখা ছিল, Brand হওয়া উচিত
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }
}
