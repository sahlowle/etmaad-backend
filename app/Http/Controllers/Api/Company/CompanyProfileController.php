<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\CompanyProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyProfileController extends BaseApiController
{
    public function show(Request $request): JsonResponse
    {
        $company = $request->user()->company();

        $company->load(['users', 'activities', 'documents', 'governorate', 'city', 'type']);

        return $this->successResponse(data: CompanyProfileResource::make($company));
    }
}
