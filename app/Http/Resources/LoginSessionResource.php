<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_agent' => $this->user_agent,
            'ip_address' => $this->ip_address,
            'device_type' => $this->device_type,
            'device' => $this->device,
            'platform' => $this->platform,
            'browser' => $this->browser,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'last_activity_at' => $this->last_activity_at,
            'label' => $this->label,
            'is_current' => $this->is_current,
            'last_active' => $this->last_active,
        ];
    }
}
