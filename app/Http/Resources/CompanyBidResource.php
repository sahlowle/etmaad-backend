<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyBidResource extends JsonResource
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
            'reference_number' => $this->reference_number,
            'technical_envelope_file_url' => file_url($this->technical_envelope_file_path),
            'guarantee_number' => $this->guarantee_number,
            'guarantee_bank' => $this->guarantee_bank,
            'guarantee_amount' => $this->guarantee_amount,
            'guarantee_expiry' => $this->guarantee_expiry,
            'guarantee_file_url' => file_url($this->guarantee_file_path),
            'submitted_at' => $this->submitted_at,
            'rejection_reason' => $this->rejection_reason,
            'status' => $this->status,
            'status_label' => $this->status->label(),
            'total_price' => $this->items->sum('total_price'),
            'tender' => $this->whenLoaded('tender'),
            'company' => $this->whenLoaded('company'),
            'items' => TenderBidItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
