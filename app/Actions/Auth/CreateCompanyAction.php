<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Enums\UserRolesEnum;
use App\Enums\UserTypeEnum;
use App\Jobs\UploadCompanyDocumentsJob;
use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Support\Facades\DB;

final readonly class CreateCompanyAction
{
    public function __construct(private CompanyService $companyService) {}

    public function handle(array $userData, array $companyData): User
    {
        return DB::transaction(function () use ($userData, $companyData): User {

            $companyAttributes = [
                ...$companyData['basic_info'],
                ...$companyData['contacts_info'],
                ...$companyData['location_info'],
                ...$companyData['financial_info'],
            ];

            $user = User::create([
                ...$userData,
                'type' => UserTypeEnum::COMPANY->value,
            ]);

            $company = Company::create($companyAttributes);

            $company->users()->attach($user->id);

            $user->assignRole(UserRolesEnum::COMPANY_MANAGER->value);

            if (isset($companyData['activities_ids'])) {
                $company->activities()->attach($companyData['activities_ids']);
            }

            if (isset($companyData['documents'])) {
                $this->uploadDocuments($company, $companyData['documents']);
            }

            return $user;
        });
    }

    private function uploadDocuments(Company $company, array $documents): void
    {
        $documents = collect($documents)->map(function ($document) {

            $tempPath = $document['file']->store('temp/documents', 'local');

            return [
                'temp_path' => $tempPath,
                'file_name' => $document['file_name'],
                'issue_date' => $document['issue_date'],
                'expiry_date' => $document['expiry_date'],
            ];
        })->toArray();

        defer(function () use ($company, $documents): void {
            $this->companyService->uploadDocuments($company, $documents);
        });

        // UploadCompanyDocumentsJob::dispatch($company, $documents)
        //     ->afterCommit();
    }
}
