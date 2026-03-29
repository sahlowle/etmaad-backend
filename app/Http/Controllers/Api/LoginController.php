<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Services\LoginService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function sessions(Request $request): JsonResponse
    {
        return $this->successResponse(
            'User sessions retrieved successfully',
            $request->user()->logins()->get()
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(
            'User logged out successfully'
        );
    }
}
