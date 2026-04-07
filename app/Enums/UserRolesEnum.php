<?php

namespace App\Enums;

enum UserRolesEnum: string
{
    case ADMIN = 'admin';
    case AGENCY = 'agency';
    case COMPANY_MANAGER = 'company_manager';
    case COMPANY_EMPLOYEE = 'company_employee';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
