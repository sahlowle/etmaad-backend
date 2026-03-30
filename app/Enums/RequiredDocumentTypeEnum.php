<?php

namespace App\Enums;

enum RequiredDocumentTypeEnum: string
{
    case INDIVIDUAL_COMPANY_REGISTER = 'individual_company_register';
    case LIMITED_LIABILITY_COMPANY_REGISTER = 'limited_liability_company_register';
    case COMPANY_REGISTER = 'company_register';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
