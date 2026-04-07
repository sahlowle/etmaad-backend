<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Enums\UserRolesEnum;
use App\Enums\UserTypeEnum;
use App\Jobs\UploadCompanyDocumentsJob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateCompanyAction
{
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

            if (isset($companyData['documents'])) {
                UploadCompanyDocumentsJob::dispatch($company, $companyData['documents'])
                    ->afterCommit();
            }

            return $user;
        });
    }
}
