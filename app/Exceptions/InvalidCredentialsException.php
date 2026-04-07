<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidCredentialsException extends BaseException
{
    protected $message = 'Invalid credentials';

    public function render(): JsonResponse
    {
        return $this->unauthorizedResponse($this->message);
    }
}
