<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidEvaluation extends Model
{
    protected $fillable = [
        'tender_bid_id',
        'tender_id',
        'company_id',
        'evaluated_by',
        'tech_level_1_score',
        'tech_level_2_score',
        'tech_level_3_score',
        'technical_percentage_success',
        'technical_total_score',
        'fin_level_1_score',
        'fin_level_2_score',
        'fin_level_3_score',
        'financial_percentage_success',
        'financial_total_score',
        'final_score',
        'notes',
        'evaluated_at',
    ];

    protected function casts(): array
    {
        return [
            'evaluated_at' => 'datetime',
            'technical_percentage_success' => 'integer',
            'technical_total_score' => 'decimal:2',
            'financial_percentage_success' => 'integer',
            'financial_total_score' => 'decimal:2',
            'final_score' => 'decimal:2',
        ];
    }

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tenderBid()
    {
        return $this->belongsTo(TenderBid::class);
    }

    public function evaluatedBy()
    {
        return $this->belongsTo(User::class, 'evaluated_by');
    }
}
