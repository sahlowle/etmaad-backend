<?php

namespace App\Services;

use App\Enums\TenderBidStatusesEnum;
use App\Exceptions\BusinessException;
use App\Models\TenderBid;

class TenderBidService
{
    public function accept(TenderBid $bid): void
    {
        if ($bid->isAccepted() || $bid->isRejected()) {
            throw new BusinessException('Bid is already accepted or rejected.');
        }

        if (TenderBid::query()->accepted()->where('tender_id', $bid->tender_id)->exists()) {
            throw new BusinessException('There is already an accepted bid for this tender.');
        }

        $bid->update([
            'status' => TenderBidStatusesEnum::ACCEPTED,
        ]);

    }

    public function reject(TenderBid $bid, string $rejectionReason): void
    {
        $bid->update([
            'status' => TenderBidStatusesEnum::REJECTED,
            'rejection_reason' => $rejectionReason,
        ]);
    }
}
