<?php

declare(strict_types=1);

namespace App\Actions\Tender;

use App\Models\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final readonly class SubmitBidAction
{
    /**
     * Execute the action.
     */
    public function handle(Tender $tender, array $data): void
    {
        $disk = 'public_uploads';

        $technicalPath = $data['technical_envelope_file']->store('tenders/attachments', $disk);
        $guaranteePath = $data['guarantee_file']->store('tenders/attachments', $disk);

        try {
            DB::transaction(function () use ($tender, $data, $technicalPath, $guaranteePath): void {
                $tender->bids()->create([
                    'company_id' => auth()->user()->company()->id,
                    'technical_envelope_file_path' => $technicalPath,
                    'guarantee_number' => $data['guarantee_number'],
                    'guarantee_bank' => $data['guarantee_bank'],
                    'guarantee_amount' => $data['guarantee_amount'],
                    'guarantee_expiry' => $data['guarantee_expiry'],
                    'guarantee_file_path' => $guaranteePath,
                ]);
            });
        } catch (\Throwable $e) {
            Storage::disk($disk)->delete([$technicalPath, $guaranteePath]);
            throw $e;
        }
    }
}
