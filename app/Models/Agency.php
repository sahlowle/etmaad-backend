<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'website',
        'address',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
