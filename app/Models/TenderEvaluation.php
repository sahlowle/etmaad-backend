<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderEvaluation extends Model
{
    protected $fillable = [
        'tender_id', 'tech_level_1', 'tech_level_2', 'tech_level_3', 'technical_weight',
        'fin_level_1', 'fin_level_2', 'fin_level_3', 'financial_weight',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
