<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Tender;
use App\Models\TenderBookPurchase;
use App\Models\User;

class TenderBookPurchaseService
{
    public function purchase(Tender $tender, User $user, array $data): TenderBookPurchase
    {
        return TenderBookPurchase::create([
            'tender_id' => $tender->id,
            'company_id' => $user->company()->id,
            'user_id' => $user->id,
            'amount' => $tender->booklet_price,
            'tender_title' => $tender->name,
            'company_name' => $user->company()->commercial_name,
            'company_commercial_registration_number' => $user->company()->commercial_registration_number,
            'payment_status' => PaymentStatusEnum::PAID,
            'payment_method' => $data['payment_method'],
        ]);
    }
}
