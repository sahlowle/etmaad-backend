<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;

class AccountBlockedException extends BaseException
{
    public function render(): JsonResponse
    {
        return $this->forbiddenResponse(__('auth.account_blocked'));
    }
}
