<?php

declare(strict_types=1);

namespace App\Actions\Tender;

use App\Models\Tender;
use App\Services\TenderService;
use Illuminate\Support\Facades\DB;

final readonly class CreateTenderAction
{
    public function __construct(private TenderService $tenderService) {}
    /**
     * Execute the action.
     */
    public function handle(array $data): Tender
    {
        return DB::transaction(function () use ($data) {
            // Create main Tender
            $tender = Tender::create($data['tender']);

            // Create One-to-One Relationships
            if (!empty($data['addresses_dates'])) {
                $tender->addressesAndDates()->create($data['addresses_dates']);
            }

            if (!empty($data['classification'])) {
                $tender->classification()->create($data['classification']);
            }

            if (!empty($data['news'])) {
                $tender->news()->create($data['news']);
            }

            if (!empty($data['evaluation'])) {
                $tender->evaluation()->create($data['evaluation']);
            }

            // Create One-to-Many Relationships
            if (!empty($data['boqs'])) {
                $tender->boqs()->createMany($data['boqs']);
            }

            if (!empty($data['attachments'])) {
                $this->tenderService->uploadAttachments($tender, $data['attachments']);
            }

            // Load relationships before returning
            return $tender->load([
                'addressesAndDates', 'classification', 'boqs', 'attachments', 'news', 'evaluation'
            ]);
        });
    }
}
