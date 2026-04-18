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
        'name', 'tender_number', 'purpose', 'booklet_price',
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

    public function isInquiriesPeriodOpen(): bool
    {
        $start = $this->addressesAndDates?->qa_start_date;
        $deadline = $this->addressesAndDates?->inquiries_deadline;

        return $start && $deadline && today()->between($start, $deadline);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(TenderBid::class);
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

    public function inquiries(): HasMany
    {
        return $this->hasMany(TenderInquiry::class);
    }

    public function news(): HasOne
    {
        return $this->hasOne(TenderNews::class);
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(TenderEvaluation::class);
    }

    public function bookPurchases()
    {
        return $this->hasMany(TenderBookPurchase::class);
    }

    public function isPurchasedBy(User $user): bool
    {
        return $this->bookPurchases()
            ->where('company_id', $user->company()->id)
            ->paid()
            ->exists();
    }

    public function isBidSubmittedBy(User $user): bool
    {
        return $this->bids()
            ->where('company_id', $user->company()->id)
            ->exists();
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

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastId = self::max('id') + 1;
            $num = 'TND-'.str_pad($lastId, 6, '0', STR_PAD_LEFT);
            $model->reference_number = $num;
            $model->tender_number = $num;
        });
    }
}
