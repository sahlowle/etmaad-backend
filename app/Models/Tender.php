<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tender extends Model
{
    protected $fillable = [
        'name', 'tender_number', 'reference_number', 'purpose', 'booklet_price',
        'status', 'execution_duration', 'requires_insurance', 'type',
        'tendering_status', 'government_entity', 'submission_method',
        'requires_initial_guarantee', 'initial_guarantee_address', 'final_guarantee_percentage'
    ];

    protected $casts = [
        'requires_insurance' => 'boolean',
        'requires_initial_guarantee' => 'boolean',
        'booklet_price' => 'decimal:2',
    ];

    public function addressesAndDates(): HasOne
    {
        return $this->hasOne(TenderAddressesDate::class);
    }

    public function classification(): HasOne
    {
        return $this->hasOne(TenderClassification::class);
    }

    public function boqs(): HasMany
    {
        return $this->hasMany(TenderBoq::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TenderAttachment::class);
    }

    public function news(): HasOne
    {
        return $this->hasOne(TenderNews::class);
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(TenderEvaluation::class);
    }
}