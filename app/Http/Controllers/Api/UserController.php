<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function me(Request $request): JsonResponse
    {
        return $this->success($request->user());
    }
}
