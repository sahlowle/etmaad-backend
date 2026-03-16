<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'website',
        'address',
        'commercial_registration_number',
        'commercial_registration_number_verified',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
