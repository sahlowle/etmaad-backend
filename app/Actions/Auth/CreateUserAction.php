<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateUserAction
{
    /**
     * Execute the action.
     */
    public function handle(array $data): User
    {
        return DB::transaction(function () use ($data): User {
            $data['type'] = UserTypeEnum::USER->value;

            return User::create($data);
        });
    }
}
