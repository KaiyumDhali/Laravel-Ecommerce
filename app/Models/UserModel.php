<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user_migration1'; // Update to match the migration table

    // Specify fillable fields for mass assignment
    protected $fillable = [
        'f_name',
        'l_name',
        'address',
        'phone',
        'email',
        'password',
    ];

    public static function RegisterAdd($request)
    {
        // Use mass assignment for clean code
        UserModel::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $request->status,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
}
