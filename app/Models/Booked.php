<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'pickup_date',
        'complete_date',
        'status',
        'customer_id',
        'staff_id',
        'payment_method_id',
        'created_at',
    ];

    public function booked_details()
    {
        return $this->hasMany(BookedDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
