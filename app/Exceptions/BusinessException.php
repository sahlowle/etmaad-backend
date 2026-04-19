<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class BusinessException extends BaseException
{
    public function __construct(
        string $message = 'Something went wrong. Please try again.',
        private readonly int $statusCode = Response::HTTP_BAD_REQUEST,
    ) {
        parent::__construct($message);
    }

    public function render(): JsonResponse
    {
        return $this->errorResponse($this->message, $this->statusCode);
    }
}
