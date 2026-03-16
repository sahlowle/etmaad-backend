<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Exceptions\InvalidCredentials;

class LoginService
{
    public function login(array $credentials): array
    {
        $user = User::query()->where('username', $credentials['username'])->first();
        $passwordValid = $user && Hash::check($credentials['password'], $user->password);

        if (! $passwordValid) {
            throw new InvalidCredentials;
        }

        if ($user->isInactive()) {
            throw new InvalidCredentials('Your account is inactive');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
