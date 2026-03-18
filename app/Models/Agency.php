<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use SoftDeletes;

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
