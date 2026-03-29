<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse(message: 'User data retrieved successfully', data: $request->user());
    }
}
