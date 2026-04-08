<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserStatusesEnum;
use App\Exceptions\AccountBlockedException;
use App\Exceptions\AccountInactiveException;
use App\Exceptions\AccountPendingException;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class LoginService
{
    public function __construct(
        private readonly Request $request,
    ) {}

    public function login(array $credentials): array
    {
        $user = User::query()
            ->where('username', $credentials['username'])
            ->first();

        // Always hash-check to prevent timing attacks
        $passwordValid = Hash::check(
            $credentials['password'],
            $user?->password ?? ''
        );

        if (! $passwordValid) {
            throw new InvalidCredentialsException;
        }

        // $this->authenticate($user);

        $token = $user->createToken($this->getCurrentDevice())->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    private function authenticate(User $user): void
    {
        match ($user->status) {
            UserStatusesEnum::ACTIVE->value => null,
            UserStatusesEnum::PENDING->value => throw new AccountPendingException,
            UserStatusesEnum::INACTIVE->value => throw new AccountInactiveException,
            UserStatusesEnum::BLOCKED->value => throw new AccountBlockedException,
        };
    }

    private function getCurrentDevice(): string
    {
        return $this->request->userAgent() ?? 'unknown-device';
    }
}
