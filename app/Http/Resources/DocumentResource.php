<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'file_url' => $this->file_path ? Storage::disk('public_uploads')->url($this->file_path) : null,
            'file_name' => $this->file_name,
            'issue_date' => $this->issue_date,
            'expiry_date' => $this->expiry_date,
        ];
    }
}
