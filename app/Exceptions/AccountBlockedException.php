<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountBlockedException extends BaseException
{
    protected $message = 'Your account has been blocked.';

    public function render(): JsonResponse
    {
        return $this->forbiddenResponse($this->message);
    }
}
