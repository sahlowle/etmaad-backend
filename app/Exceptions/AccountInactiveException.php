<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountInactiveException extends BaseException
{
    protected $message = 'Your account is inactive.';

    public function render(): JsonResponse
    {
        return $this->forbiddenResponse($this->message);
    }
}
