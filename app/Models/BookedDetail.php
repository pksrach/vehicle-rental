<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedDetail extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'booked_id',
        'vehicle_id',
        'service_price',
        'discount',
    ];

    public function booked()
    {
        return $this->belongsTo(Booked::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
