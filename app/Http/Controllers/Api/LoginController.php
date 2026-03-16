<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Services\LoginService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class LoginController extends BaseApiController
{
    use ApiResponse;

    public function login(LoginRequest $request, LoginService $loginService): JsonResponse
    {
        $result = $loginService->login($request->only('username', 'password'));

        return $this->successResponse(
            'User logged in successfully',
            [
                'token' => $result['token'],
                'user' => $result['user'],
            ]
        );

    }
}
