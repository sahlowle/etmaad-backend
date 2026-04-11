<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountRejectedException extends BaseException
{
    protected $message = 'Your account is rejected.';

    public function render(): JsonResponse
    {
        return $this->forbiddenResponse($this->message);
    }
}
