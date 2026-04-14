<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case ONLINE = 'online';
    case BANK_TRANSFER = 'bank_transfer';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
