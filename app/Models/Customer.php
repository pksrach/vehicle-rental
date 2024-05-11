<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends SoftDeleteModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'card_identify',
        'attachment',
        'is_active',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function displayName()
    {
        return $this->first_name . ' ' . $this->last_name . ' (' . $this->phone . ')';
    }

    public function profileName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function profileImage()
    {
        return $this->attachment ? '/uploads/thumbnail/' . $this->attachment : 'no_person.png';
    }
}
