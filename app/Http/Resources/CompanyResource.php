<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'commercial_name' => $this->commercial_name,
            'commercial_registration_number' => $this->commercial_registration_number,
            'status' => $this->status,
            'status_label' => $this->status->label(),
            // 'created_at' => $this->created_at->format('Y-m-d'),
            'documents' => DocumentResource::collection($this->whenLoaded('documents')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
        ];

    }
}
