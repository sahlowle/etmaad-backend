<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class InvalidCredentials extends BaseException
{
    public function render(): JsonResponse
    {
        return $this->unauthorizedResponse(__('auth.invalid_credentials'));
    }

    public function report() {}
}
