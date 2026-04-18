<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\CompanyStatusesEnum;
use App\Enums\UserStatusesEnum;
use App\Enums\UserTypeEnum;
use App\Exceptions\AccountBlockedException;
use App\Exceptions\AccountInactiveException;
use App\Exceptions\AccountPendingException;
use App\Exceptions\AccountRejectedException;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class LoginService
{
    public function __construct(
        private readonly Request $request,
    ) {}

    public function adminLogin(array $credentials): array
    {
        $user = $this->resolveUser(UserTypeEnum::ADMIN, $credentials['username']);

        $this->verifyPassword($credentials['password'], $user?->password);

        $this->verifyUserStatus($user);

        return $this->issueToken($user);
    }

    public function companyLogin(array $credentials): array
    {
        $user = $this->resolveUser(UserTypeEnum::COMPANY, $credentials['username']);

        $this->verifyPassword($credentials['password'], $user?->password);

        // Verify user account status first before diving into company-level checks
        $this->verifyUserStatus($user);

        $this->verifyCompanyStatus($user->company());

        return $this->issueToken($user);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Find a user by type and username, optionally eager-loading relationships.
     * Returns null when not found so verifyPassword() can still run a dummy
     * hash-check and prevent timing attacks.
     */
    private function resolveUser(UserTypeEnum $type, string $username, array $with = []): ?User
    {
        return User::query()
            ->where('type', $type->value)
            ->where('username', $username)
            ->with($with)
            ->first();
    }

    /**
     * Always runs a Hash::check — even when $user is null — to prevent
     * timing-based username enumeration attacks.
     *
     * @throws InvalidCredentialsException
     */
    private function verifyPassword(string $plain, ?string $hashed): void
    {
        $valid = Hash::check($plain, $hashed ?? '');

        if (! $valid) {
            throw new InvalidCredentialsException;
        }
    }

    /**
     * @throws AccountPendingException
     * @throws AccountInactiveException
     * @throws AccountBlockedException
     */
    private function verifyUserStatus(User $user): void
    {
        match ($user->status) {
            UserStatusesEnum::ACTIVE->value => null,
            UserStatusesEnum::PENDING->value => throw new AccountPendingException,
            UserStatusesEnum::INACTIVE->value => throw new AccountInactiveException,
            UserStatusesEnum::BLOCKED->value => throw new AccountBlockedException,
            default => throw new InvalidCredentialsException, // unknown/future status
        };
    }

    /**
     * @throws AccountPendingException
     * @throws AccountInactiveException
     * @throws AccountRejectedException
     */
    private function verifyCompanyStatus(mixed $company): void
    {
        match ($company->status->value) {
            CompanyStatusesEnum::APPROVED->value => null,
            CompanyStatusesEnum::PENDING->value => throw new AccountPendingException,
            CompanyStatusesEnum::INACTIVE->value => throw new AccountInactiveException,
            CompanyStatusesEnum::REJECTED->value => throw new AccountRejectedException,
            default => throw new InvalidCredentialsException,
        };
    }

    /**
     * Create a Sanctum token for the authenticated user and return the
     * standard response payload.
     */
    private function issueToken(User $user): array
    {
        $token = $user->createToken($this->currentDevice())->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    private function currentDevice(): string
    {
        return $this->request->userAgent() ?? 'unknown-device';
    }
}
