<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units'; // Update to match the migration table
   
    // Specify fillable fields for mass assignment
    protected $fillable = [
        'unit',
        
    ];

    
    public static function UnitAdd($request)
    {
        // Use mass assignment for clean code
        Unit::create([
            'unit' => $request->unit,
        
        ]);
    }
}