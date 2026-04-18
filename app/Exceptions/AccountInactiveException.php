<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountInactiveException extends BaseException
{
    public function render(): JsonResponse
    {
        return $this->forbiddenResponse(__('auth.account_inactive'));
    }
}
