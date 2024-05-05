<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'role',
        'phone',
        'gender',
        'date_of_birth',
        'address',
        'hire_date',
        'attachment',
        'is_active',
        'user_id',
        'salary',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
