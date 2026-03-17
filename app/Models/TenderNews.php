<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderNews extends Model
{
    protected $fillable = [
        'tender_id', 'creation_date', 'updated_offers_opening_date',
        'extension_notes', 'actual_award_date',
    ];

    protected $casts = [
        'creation_date' => 'date',
        'updated_offers_opening_date' => 'datetime',
        'actual_award_date' => 'date',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
