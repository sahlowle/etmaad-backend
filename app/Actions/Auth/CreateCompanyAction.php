<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateCompanyAction
{
    /**
     * Execute the action.
     */
    public function handle(array $user, array $company): User
    {
        return DB::transaction(function () use ($user, $company): User {

            $user['type'] = UserTypeEnum::COMPANY->value;

            $user = User::create($user);

            $company = Company::create($company);

            $company->users()->attach($user->id);

            $user->assignRole($user['type']);

            return $user;
        });
    }
}
