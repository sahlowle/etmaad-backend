<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BidEvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tender_bid_id' => $this->tender_bid_id,
            'tender_id' => $this->tender_id,
            'company_id' => $this->company_id,
            'evaluated_by' => $this->evaluated_by,
            'tech_level_1_score' => $this->tech_level_1_score,
            'tech_level_2_score' => $this->tech_level_2_score,
            'tech_level_3_score' => $this->tech_level_3_score,
            'technical_percentage_success' => $this->technical_percentage_success,
            'technical_total_score' => $this->technical_total_score,
            'fin_level_1_score' => $this->fin_level_1_score,
            'fin_level_2_score' => $this->fin_level_2_score,
            'fin_level_3_score' => $this->fin_level_3_score,
            'financial_percentage_success' => $this->financial_percentage_success,
            'financial_total_score' => $this->financial_total_score,
            'final_score' => $this->final_score,
            'notes' => $this->notes,
            'evaluated_at' => $this->evaluated_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => CompanyResource::make($this->whenLoaded('company')),
            'tenderBid' => TenderBidResource::make($this->whenLoaded('tenderBid')),
            'evaluatedBy' => UserResource::make($this->whenLoaded('evaluatedBy')),
        ];
    }
}
