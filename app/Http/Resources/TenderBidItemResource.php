<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderBidItemResource extends JsonResource
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
            'tender_boq_id' => $this->tender_boq_id,
            'unit_price' => $this->unit_price,
            'total_price' => $this->total_price,
            'tender_boq' => new TenderBoqResource($this->whenLoaded('tenderBoq')),
        ];
    }
}
