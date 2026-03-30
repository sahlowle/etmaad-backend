<?php

namespace App\Models;

use App\Enums\TenderStatusesEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'tender_number', 'reference_number', 'purpose', 'booklet_price',
        'status', 'execution_duration', 'requires_insurance', 'type',
        'tendering_status', 'government_entity', 'submission_method',
        'requires_initial_guarantee', 'initial_guarantee_address', 'final_guarantee_percentage',
    ];

    protected function casts(): array
    {
        return [
            'requires_insurance' => 'boolean',
            'requires_initial_guarantee' => 'boolean',
            'booklet_price' => 'decimal:2',
            'status' => TenderStatusesEnum::class,
        ];
    }

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

    #[Scope]
    public function published(Builder $query): void
    {
        $query->where('status', TenderStatusesEnum::PUBLISHED->value);
    }

    #[Scope]
    public function pending(Builder $query): void
    {
        $query->where('status', TenderStatusesEnum::PENDING->value);
    }

    #[Scope]
    public function draft(Builder $query): void
    {
        $query->where('status', TenderStatusesEnum::DRAFT->value);
    }

    #[Scope]
    public function closed(Builder $query): void
    {
        $query->where('status', TenderStatusesEnum::CLOSED->value);
    }

    #[Scope]
    public function cancelled(Builder $query): void
    {
        $query->where('status', TenderStatusesEnum::CANCELLED->value);
    }

    public function isPublished(): bool
    {
        return $this->status->value === TenderStatusesEnum::PUBLISHED->value;
    }

    public function isNotPublished(): bool
    {
        return ! $this->isPublished();
    }

    public function isPending(): bool
    {
        return $this->status->value === TenderStatusesEnum::PENDING->value;
    }

    public function isDraft(): bool
    {
        return $this->status->value === TenderStatusesEnum::DRAFT->value;
    }

    public function isClosed(): bool
    {
        return $this->status->value === TenderStatusesEnum::CLOSED->value;
    }

    public function isCancelled(): bool
    {
        return $this->status->value === TenderStatusesEnum::CANCELLED->value;
    }
}
