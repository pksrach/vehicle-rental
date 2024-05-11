<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function displayName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function profileName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getRole(): string
    {
        return ucfirst($this->role);
    }

    public function profileImage()
    {
        return $this->attachment ? '/uploads/thumbnail/' . $this->attachment : 'no_person.png';
    }
}
