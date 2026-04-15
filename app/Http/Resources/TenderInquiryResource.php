<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderInquiryResource extends JsonResource
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
            'question' => $this->question,
            'answer' => $this->answer,
            'answered_at' => $this->answered_at?->format('Y-m-d H:i:s'),
            'answered_by' => $this->answered_by,
            'user' => $this->whenLoaded('user'),
            'company' => $this->whenLoaded('company'),
            'answeredBy' => $this->whenLoaded('answeredBy'),
        ];
    }
}
