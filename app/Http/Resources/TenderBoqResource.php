<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderBoqResource extends JsonResource
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
            'tender_id' => $this->tender_id,
            'table_name' => $this->table_name,
            'serial_number' => $this->serial_number,
            'category' => $this->category,
            'item_name' => $this->item_name,
            'unit' => $this->unit,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'specifications' => $this->specifications,
            'is_mandatory_list_product' => $this->is_mandatory_list_product,
        ];
    }
}
