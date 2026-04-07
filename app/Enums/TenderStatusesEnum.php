<?php

namespace App\Enums;

enum TenderStatusesEnum: string
{
    case PENDING = 'pending';
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CLOSED = 'closed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => api_trans('tender.pending'),
            self::DRAFT => api_trans('tender.draft'),
            self::PUBLISHED => api_trans('tender.published'),
            self::CLOSED => api_trans('tender.closed'),
            self::CANCELLED => api_trans('tender.cancelled'),
            default => api_trans('tender.pending'),
        };
    }

    public static function getLabel(string $status): string
    {
        return match ($status) {
            self::PENDING->value => api_trans('tender.pending'),
            self::DRAFT->value => api_trans('tender.draft'),
            self::PUBLISHED->value => api_trans('tender.published'),
            self::CLOSED->value => api_trans('tender.closed'),
            self::CANCELLED->value => api_trans('tender.cancelled'),
            default => api_trans('tender.pending'),
        };
    }

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
