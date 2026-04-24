<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderEvaluation extends Model
{
    protected $fillable = [
        'tender_id',
        'tech_level_1_name',
        'tech_level_1_percentage',
        'tech_level_2_name',
        'tech_level_2_percentage',
        'tech_level_3_name',
        'tech_level_3_percentage',
        'technical_weight',
        'technical_percentage_success',
        'fin_level_1_name',
        'fin_level_1_percentage',
        'fin_level_2_name',
        'fin_level_2_percentage',
        'fin_level_3_name',
        'fin_level_3_percentage',
        'financial_weight',
        'financial_percentage_success',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
