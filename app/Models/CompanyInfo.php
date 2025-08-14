<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'company_name',
        'mobile',
        'email',
        'mission',
        'vision',
        'values',
        'company_address',
        'company_logo', // <-- use the same name as your DB column
    ];
}

