<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'payment_name',
        'account_name',
        'account_number',
        'links',
        'is_active',
    ];
}
