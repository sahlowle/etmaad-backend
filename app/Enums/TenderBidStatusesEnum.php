<?php

namespace App\Enums;

enum TenderBidStatusesEnum: string
{
    case UNDER_REVIEW = 'under_review';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::UNDER_REVIEW => api_trans('tender_bid.under_review'),
            self::ACCEPTED => api_trans('tender_bid.accepted'),
            self::REJECTED => api_trans('tender_bid.rejected'),
            default => api_trans('tender_bid.under_review'),
        };
    }

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
