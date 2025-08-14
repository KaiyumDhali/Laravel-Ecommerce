<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes'; // টেবিলের নাম স্পষ্ট করে দেওয়া
    protected $fillable = ['size'];

    // সম্পর্ক — এক সাইজ অনেক প্রোডাক্টে থাকতে পারে
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size', 'size_id', 'product_id');
    }

    // Static add method (Laravel way)
    public static function addSize($request)
    {
        return self::create([
            'size' => $request->size
        ]);
    }
}
