<?php

declare(strict_types=1);

namespace App\Actions\Tender;

use App\Models\Tender;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class SubmitBidAction
{
    public function __construct(
        private FileUploadService $uploader,
    ) {}

    /**
     * Execute the action.
     */
    public function handle(Tender $tender, array $data): void
    {
        $path = 'enders/attachments';

        $technicalPath = $this->uploader->store($data['technical_envelope_file'], $path);
        $guaranteePath = $this->uploader->store($data['guarantee_file'], $path);

        try {
            DB::transaction(function () use ($tender, $data, $technicalPath, $guaranteePath): void {

                $bid = $tender->bids()->create([
                    // Fix: accessed relationship as a property, not a method
                    'company_id' => auth()->user()->company()->id,
                    'technical_envelope_file_path' => $technicalPath,
                    'guarantee_number' => $data['guarantee_number'],
                    'guarantee_bank' => $data['guarantee_bank'],
                    'guarantee_amount' => $data['guarantee_amount'],
                    'guarantee_expiry' => $data['guarantee_expiry'],
                    'guarantee_file_path' => $guaranteePath,
                    'submitted_at' => now(),
                ]);

                $items = collect($data['items']);

                // Optimization: Pluck only the required 'quantity' mapped by 'id'
                // instead of hydrating full Eloquent models
                $boqQuantities = $tender->boqs()
                    ->whereIn('id', $items->pluck('tender_boq_id'))
                    ->get(['id', 'quantity', 'item_name'])
                    ->keyBy('id');

                // dd($boqQuantities);

                $bidItems = $items->map(fn (array $item) => [
                    'tender_boq_id' => $item['tender_boq_id'],
                    'unit_price' => $item['unit_price'],
                    'name' => $boqQuantities->get($item['tender_boq_id'])->item_name,
                    'total_price' => $boqQuantities->get($item['tender_boq_id'])->quantity * $item['unit_price'],
                ])->toArray();

                // Fix: Insert the correctly mapped items with total_price
                $bid->items()->createMany($bidItems);

            });
        } catch (Throwable $e) {
            $this->uploader->delete([$technicalPath, $guaranteePath]);
            throw $e;
        }
    }
}
