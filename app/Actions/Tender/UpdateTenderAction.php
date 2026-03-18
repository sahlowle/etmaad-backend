<?php

declare(strict_types=1);

namespace App\Actions\Tender;

use App\Models\Tender;
use App\Services\TenderService;
use Illuminate\Support\Facades\DB;

final readonly class UpdateTenderAction
{
    public function __construct(private TenderService $tenderService) {}

    /**
     * Execute the action.
     */
    public function handle(Tender $tender, array $data): Tender
    {
        return DB::transaction(function () use ($tender, $data) {
            // Update main Tender
            if (filled($data['tender'])) {
                $tender->update($data['tender']);
            }

            // Update One-to-One Relationships
            if (filled($data['addresses_dates'])) {
                $tender->addressesAndDates()->updateOrCreate(
                    ['tender_id' => $tender->id],
                    $data['addresses_dates']
                );
            }

            if (filled($data['classification'])) {
                $tender->classification()->updateOrCreate(
                    ['tender_id' => $tender->id],
                    $data['classification']
                );
            }

            if (filled($data['news'])) {
                $tender->news()->updateOrCreate(
                    ['tender_id' => $tender->id],
                    $data['news']
                );
            }

            if (filled($data['evaluation'])) {
                $tender->evaluation()->updateOrCreate(
                    ['tender_id' => $tender->id],
                    $data['evaluation']
                );
            }

            // Update One-to-Many Relationships
            if (filled($data['boqs'])) {
                $tender->boqs()->delete();
                $tender->boqs()->createMany($data['boqs']);
            }

            // if (filled($data['attachments'])) {
            //     $this->tenderService->uploadAttachments($tender, $data['attachments']);
            // }

            // Load relationships before returning
            return $tender->load([
                'addressesAndDates', 'classification', 'boqs', 'attachments', 'news', 'evaluation',
            ]);
        });
    }
}
