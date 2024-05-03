<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'attachment',
    ];
}
