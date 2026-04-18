<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderBid extends Model
{
    protected $fillable = [
        'tender_id',
        'company_id',
        'reference_number',
        'technical_envelope_file_path',
        'guarantee_type',
        'guarantee_number',
        'guarantee_bank',
        'guarantee_amount',
        'guarantee_expiry',
        'guarantee_file_path',
        'submitted_at',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'guarantee_amount' => 'decimal:2',
            'guarantee_expiry' => 'date',
            'submitted_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastId = self::max('id') + 1;
            $num = 'BID-'.str_pad($lastId, 6, '0', STR_PAD_LEFT);
            $model->reference_number = $num;
        });
    }
}
