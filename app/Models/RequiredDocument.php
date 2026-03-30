<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RequiredDocument extends Model
{
    use HasTranslations;

    public array $translatable = ['file_name'];

    protected $fillable = [
        'file_name',
        'issue_date',
        'expire_date',
        'type',
        'is_required',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expire_date' => 'date',
            'is_required' => 'boolean',
        ];
    }
}
