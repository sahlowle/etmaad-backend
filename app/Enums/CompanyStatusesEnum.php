<?php

namespace App\Enums;

enum CompanyStatusesEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case INACTIVE = 'inactive';
    case REJECTED = 'rejected';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => api_trans('company.pending'),
            self::APPROVED => api_trans('company.approved'),
            self::INACTIVE => api_trans('company.inactive'),
            self::REJECTED => api_trans('company.rejected'),
        };
    }

    public static function listStatuses(): array
    {
        return [
            ['key' => self::PENDING->value, 'label' => self::PENDING->label()],
            ['key' => self::APPROVED->value, 'label' => self::APPROVED->label()],
            ['key' => self::INACTIVE->value, 'label' => self::INACTIVE->label()],
            ['key' => self::REJECTED->value, 'label' => self::REJECTED->label()],
        ];
    }
}
