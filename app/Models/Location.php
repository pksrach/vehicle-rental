<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];
}
