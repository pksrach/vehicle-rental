<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'attachment',
        'is_active',
        'category_id',
        'brand_id',
        'location_id',
    ];
}
