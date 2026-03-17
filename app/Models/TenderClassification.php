<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderClassification extends Model
{
    protected $fillable = [
        'tender_id', 'classification_area', 'execution_location', 'details',
        'scope', 'includes_supply', 'includes_maintenance',
    ];

    protected $casts = [
        'includes_supply' => 'boolean',
        'includes_maintenance' => 'boolean',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
