<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountPendingException extends BaseException
{
    protected $message = 'Your account is pending approval.';

    public function render(): JsonResponse
    {
        return $this->forbiddenResponse($this->message);
    }
}
