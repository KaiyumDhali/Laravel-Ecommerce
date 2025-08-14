<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','user_name', 'City','full_address','user_email','user_phone','total_amount','payment_method', 'status'];

    // Each order can have many order details
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
