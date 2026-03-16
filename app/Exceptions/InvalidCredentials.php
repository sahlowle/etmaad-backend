<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\BaseException;
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
