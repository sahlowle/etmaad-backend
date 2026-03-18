<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case COMPANY = 'company';
    case AGENCY = 'agency';

    public static function toArray(): array
    {
        return [
            self::USER->value,
            self::ADMIN->value,
            self::COMPANY->value,
            self::AGENCY->value,
        ];
    }
}
