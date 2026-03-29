<?php

namespace App\Services;

use App\Exceptions\InvalidCredentials;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

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

        $token = $user->createToken($this->getCurrentDevice())->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function getCurrentDevice(): string
    {
        $agent = new Agent;
        $device = $agent->device();

        return $device ?: 'unknown-device';
    }
}
