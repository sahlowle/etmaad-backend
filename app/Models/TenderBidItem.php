<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderBidItem extends Model
{
    protected $fillable = [
        'tender_bid_id',
        'tender_boq_id',
        'name',
        'unit_price',
        'total_price',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function tenderBid(): BelongsTo
    {
        return $this->belongsTo(TenderBid::class);
    }

    public function tenderBoq(): BelongsTo
    {
        return $this->belongsTo(TenderBoq::class);
    }
}
