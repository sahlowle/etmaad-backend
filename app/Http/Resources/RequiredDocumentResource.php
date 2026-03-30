<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequiredDocumentResource extends JsonResource
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
            'file_name' => $this->file_name,
            'issue_date' => $this->issue_date?->format('Y-m-d'),
            'expire_date' => $this->expire_date?->format('Y-m-d'),
            'type' => $this->type,
            'is_required' => $this->is_required,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
