<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\CompanyStatusesEnum;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\ChangeCompanyStatusRequest;
use App\Http\Resources\CompanyDetailsResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends BaseApiController
{
    public function getInsights(): JsonResponse
    {
        return $this->successResponse(
            data: [
                'total' => Company::count(),
                'pending' => Company::where('status', CompanyStatusesEnum::PENDING)->count(),
                'approved' => Company::where('status', CompanyStatusesEnum::APPROVED)->count(),
                'inactive' => Company::where('status', CompanyStatusesEnum::INACTIVE)->count(),
                'rejected' => Company::where('status', CompanyStatusesEnum::REJECTED)->count(),
            ]
        );
    }

    public function index(): JsonResponse
    {
        $companies = Company::query()
            ->select('id', 'commercial_name', 'commercial_registration_number', 'status')
            ->with('documents', 'activities')
            ->paginate(15);

        return $this->paginatedResponse(
            paginator: CompanyResource::collection($companies)->resource
        );
    }

    public function show(Company $company): JsonResponse
    {
        $company->activities()->attach([1, 2, 3]);

        $company->loadMissing([
            'documents',
            'activities',
            'type',
            'governorate',
            'city',
        ]);

        return $this->successResponse(
            data: new CompanyDetailsResource($company)
        );
    }

    public function getStatuses(): JsonResponse
    {
        return $this->successResponse(
            data: CompanyStatusesEnum::listStatuses()
        );
    }

    public function changeStatus(ChangeCompanyStatusRequest $request, Company $company): JsonResponse
    {
        $company->update([
            'status' => $request->status,
        ]);

        return $this->successResponse();
    }
}
