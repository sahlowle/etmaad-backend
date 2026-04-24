<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderBidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tender_id' => $this->tender_id,
            'company_id' => $this->company_id,
            'reference_number' => $this->reference_number,
            'technical_envelope_file_path' => file_url($this->technical_envelope_file_path),
            'guarantee_type' => $this->guarantee_type,
            'guarantee_number' => $this->guarantee_number,
            'guarantee_bank' => $this->guarantee_bank,
            'guarantee_amount' => $this->guarantee_amount,
            'guarantee_expiry' => $this->guarantee_expiry,
            'guarantee_file_path' => file_url($this->guarantee_file_path),
            'submitted_at' => $this->submitted_at,
            'rejection_reason' => $this->rejection_reason,
            'is_technical_evaluation_added' => $this->is_technical_evaluation_added,
            'is_financial_evaluation_added' => $this->is_financial_evaluation_added,

        ];
    }
}
