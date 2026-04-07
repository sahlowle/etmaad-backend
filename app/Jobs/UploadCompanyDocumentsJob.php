<?php

namespace App\Jobs;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UploadCompanyDocumentsJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(
        private readonly Company $company,
        private readonly array $documents,
    ) {}

    public function handle(CompanyService $companyService): void
    {
        $companyService->uploadDocuments($this->company, $this->documents);
    }
}
