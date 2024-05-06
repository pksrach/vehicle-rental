<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function displayName()
    {
        return $this->payment_name . ' ' . $this->account_name . ' ' . $this->account_number;
    }
}
