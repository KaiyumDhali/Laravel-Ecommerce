<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors'; // টেবিলের নাম
    protected $fillable = ['color'];

    // সম্পর্ক — এক কালার অনেক প্রোডাক্টে থাকতে পারে
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color', 'color_id', 'product_id');
    }

    // Static add method (Laravel way)
    public static function addColor($request)
    {
        return self::create([
            'color' => $request->color
        ]);
    }
}
