<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\CreateCompanyAction;
use App\Actions\Auth\CreateUserAction;
use App\Http\Requests\Api\StoreNewCompanyRequest;
use App\Http\Requests\Api\StoreNewUserRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseApiController
{
    public function registerUser(StoreNewUserRequest $request, CreateUserAction $createUserAction): JsonResponse
    {

        $user = $createUserAction->handle($request->validated());

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->successResponse(
            'User registered successfully',
            [
                'token' => $token,
                'user' => $user,
            ]
        );
    }

    public function registerCompany(StoreNewCompanyRequest $request, CreateCompanyAction $createCompanyAction): JsonResponse
    {
        $userData = $request->validated('user');

        $companyData = $request->validated('company');

        $user = $createCompanyAction->handle($userData, $companyData);

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->successResponse(
            'Company registered successfully',
            [
                'token' => $token,
                'user' => $user,
            ]
        );
    }
}
