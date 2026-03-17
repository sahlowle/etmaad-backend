<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderAddressesDate extends Model
{
    protected $fillable = [
        'tender_id', 'inquiries_deadline', 'offers_deadline', 'offers_opening_date',
        'offers_examination_date', 'evaluation_duration_days', 'expected_award_date',
        'execution_start_date', 'qa_start_date', 'qa_response_deadline',
        'offers_opening_location', 'opening_committee_members',
    ];

    protected $casts = [
        'inquiries_deadline' => 'datetime',
        'offers_deadline' => 'datetime',
        'offers_opening_date' => 'datetime',
        'offers_examination_date' => 'datetime',
        'expected_award_date' => 'date',
        'execution_start_date' => 'date',
        'qa_start_date' => 'datetime',
        'qa_response_deadline' => 'datetime',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
