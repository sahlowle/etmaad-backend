<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderBoq extends Model
{
    protected $fillable = [
        'tender_id', 'table_name', 'serial_number', 'category', 'item_name',
        'unit', 'quantity', 'description', 'specifications', 'is_mandatory_list_product',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'is_mandatory_list_product' => 'boolean',
    ];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
