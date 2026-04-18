<?php

namespace App\Enums;

enum TenderBidGuaranteeTypeEnum: string
{
    case BANK_LETTER = 'bank_letter';
    case CHEQUE = 'cheque';
    case CASH = 'cash';
}
