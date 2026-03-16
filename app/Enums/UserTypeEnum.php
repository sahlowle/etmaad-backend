<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case COMPANY = 'company';
    case AGENCY = 'agency';
}
