<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BidEvaluation;
use App\Models\TenderBid;

class BidEvaluationService
{
    public function techEvaluate(TenderBid $tenderBid, array $data): void
    {
        $tender = $tenderBid->tender->load('evaluation');
        $data['technical_total_score'] = collect($data)->values()->sum();
        $data['technical_percentage_success'] = $tender->evaluation->technical_percentage_success;

        $evaluation = BidEvaluation::updateOrCreate(
            ['tender_bid_id' => $tenderBid->id],
            $data + [
                'tender_id' => $tenderBid->tender_id,
                'company_id' => $tenderBid->company_id,
                'evaluated_by' => auth()->id(),
                'evaluated_at' => now(),
            ]
        );

        if ($evaluation->wasRecentlyCreated || $evaluation->wasChanged()) {
            $tenderBid->update(['is_technical_evaluation_added' => true]);
        }

    }

    public function finEvaluate(TenderBid $tenderBid, array $data): void
    {
        $tender = $tenderBid->tender->load('evaluation');
        $data['financial_total_score'] = collect($data)->values()->sum();
        $data['financial_percentage_success'] = $tender->evaluation->financial_percentage_success;

        $evaluation = BidEvaluation::where('tender_bid_id', $tenderBid->id)->firstOrFail();

        $evaluation->update($data);

        $evaluation->increment('final_score', $data['financial_total_score']);

        $tenderBid->update(['is_financial_evaluation_added' => true]);
    }
}
