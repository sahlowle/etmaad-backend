<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    protected $fillable = [
        'company_id',
        'file_path',
        'file_name',
        'issue_date',
        'expiry_date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
