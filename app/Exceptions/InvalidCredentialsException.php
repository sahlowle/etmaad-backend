<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidCredentialsException extends BaseException
{
    public function render(): JsonResponse
    {
        return $this->unauthorizedResponse(__('auth.invalid_credentials'));
    }
}
