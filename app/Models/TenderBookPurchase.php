<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderBookPurchase extends Model
{
    protected $fillable = [
        'serial_number',
        'tender_id',
        'company_id',
        'user_id',
        'tender_title',
        'company_name',
        'company_commercial_registration_number',
        'amount',
        'payment_status',
        'payment_method',
        'payment_id',
    ];

    protected function casts(): array
    {
        return [
            'payment_status' => PaymentStatusEnum::class,
            'payment_method' => PaymentMethodEnum::class,
        ];
    }

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === PaymentStatusEnum::PAID;
    }

    #[Scope]
    public function paid(Builder $query): void
    {
        $query->where('payment_status', PaymentStatusEnum::PAID);
    }

    #[Scope]
    public function pending(Builder $query): void
    {
        $query->where('payment_status', PaymentStatusEnum::PENDING);
    }

    #[Scope]
    public function failed(Builder $query): void
    {
        $query->where('payment_status', PaymentStatusEnum::FAILED);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastId = self::max('id') + 1;
            $model->serial_number = 'TND-'.str_pad($lastId, 6, '0', STR_PAD_LEFT);
        });
    }
}
