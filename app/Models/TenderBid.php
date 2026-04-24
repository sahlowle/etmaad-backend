<?php

namespace App\Models;

use App\Enums\TenderBidStatusesEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TenderBid extends Model
{
    protected $fillable = [
        'tender_id',
        'company_id',
        'reference_number',
        'technical_envelope_file_path',
        'guarantee_type',
        'guarantee_number',
        'guarantee_bank',
        'guarantee_amount',
        'guarantee_expiry',
        'guarantee_file_path',
        'submitted_at',
        'rejection_reason',
        'status',
        'is_technical_evaluation_added',
        'is_financial_evaluation_added',
    ];

    protected function casts(): array
    {
        return [
            'status' => TenderBidStatusesEnum::class,
            'guarantee_amount' => 'decimal:2',
            'guarantee_expiry' => 'date',
            'submitted_at' => 'datetime',
            'is_technical_evaluation_added' => 'boolean',
            'is_financial_evaluation_added' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    public function bidEvaluation(): HasOne
    {
        return $this->hasOne(BidEvaluation::class);
    }

    public function items()
    {
        return $this->hasMany(TenderBidItem::class);
    }

    public function isAccepted(): bool
    {
        return $this->status === TenderBidStatusesEnum::ACCEPTED;
    }

    public function isRejected(): bool
    {
        return $this->status === TenderBidStatusesEnum::REJECTED;
    }

    #[Scope]
    public function accepted(Builder $query): void
    {
        $query->where('status', TenderBidStatusesEnum::ACCEPTED);
    }

    #[Scope]
    public function rejected(Builder $query): void
    {
        $query->where('status', TenderBidStatusesEnum::REJECTED);
    }

    #[Scope]
    public function underReview(Builder $query): void
    {
        $query->where('status', TenderBidStatusesEnum::UNDER_REVIEW);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastId = self::max('id') + 1;
            $num = 'BID-'.str_pad($lastId, 6, '0', STR_PAD_LEFT);
            $model->reference_number = $num;
        });
    }
}
