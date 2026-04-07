<?php

namespace App\Enums;

enum UserStatusesEnum: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BLOCKED = 'blocked';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function implode(string $separator = ', '): string
    {
        return implode($separator, self::values());
    }
}
