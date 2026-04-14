<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
