<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderDetailsForCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Main Tender Fields (Tab 1)
            'id' => $this->id,
            'name' => $this->name,
            'tender_number' => $this->tender_number,
            'reference_number' => $this->reference_number,
            'purpose' => $this->purpose,
            'booklet_price' => $this->booklet_price ? (float) $this->booklet_price : null,
            'status' => $this->status,
            'status_label' => $this->status->label(),
            'execution_duration' => $this->execution_duration,
            'requires_insurance' => (bool) $this->requires_insurance,
            'type' => $this->type,
            'tendering_status' => $this->tendering_status,
            'government_entity' => $this->government_entity,
            'submission_method' => $this->submission_method,
            'requires_initial_guarantee' => (bool) $this->requires_initial_guarantee,
            'initial_guarantee_address' => $this->initial_guarantee_address,
            'final_guarantee_percentage' => $this->final_guarantee_percentage,

            'is_inquiries_period_open' => $this->isInquiriesPeriodOpen(),

            'inquiries' => InquiryResource::collection($this->whenLoaded('inquiries')),

            // Timestamps
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Relationships (Conditionally loaded to prevent N+1 queries)
            'addresses_dates' => $this->whenLoaded('addressesAndDates'),
            'classification' => $this->whenLoaded('classification'),
            'boqs' => $this->whenLoaded('boqs'),
            // 'attachments' => TenderAttachmentResource::collection($this->whenLoaded('attachments')),
            'news' => $this->whenLoaded('news'),
            'evaluation' => $this->whenLoaded('evaluation'),

            'is_purchased' => $this->isPurchasedBy(auth()->user()),
        ];
    }
}
