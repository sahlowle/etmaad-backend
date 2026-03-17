<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class InvalidCredentials extends BaseException
{
    protected $message = 'Invalid credentials';

    public function render(): JsonResponse
    {
        return $this->unauthorizedResponse($this->message);
    }

    public function report() {}
}
