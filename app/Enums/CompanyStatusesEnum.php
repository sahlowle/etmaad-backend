<?php

namespace App\Enums;

enum CompanyStatusesEnum: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case REJECTED = 'rejected';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
