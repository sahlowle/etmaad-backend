<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreCompanyTypeRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateCompanyTypeRequest;
use App\Http\Resources\CompanyTypeResource;
use App\Models\CompanyType;
use Illuminate\Http\JsonResponse;

class CompanyTypeController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $companyTypes = CompanyType::query()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: CompanyTypeResource::collection($companyTypes)->resource
        );
    }

    public function store(StoreCompanyTypeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $name = $validated['name'];

        $validated['slug'] = generateSlug($name['en'], CompanyType::getModel()->getTable(), 'slug');

        $companyType = CompanyType::create($validated);

        return $this->successResponse(
            message: api_trans('success'),
            data: new CompanyTypeResource($companyType)
        );
    }

    public function show(CompanyType $companyType): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new CompanyTypeResource($companyType)
        );
    }

    public function update(UpdateCompanyTypeRequest $request, CompanyType $companyType): JsonResponse
    {
        $validated = $request->validated();

        $name = $validated['name'];

        $validated['slug'] = generateSlug($name['en'], CompanyType::getModel()->getTable(), 'slug', $companyType->id);

        $companyType->update($validated);

        return $this->successResponse(
            message: api_trans('success'),
            data: new CompanyTypeResource($companyType)
        );
    }

    public function destroy(CompanyType $companyType): JsonResponse
    {
        $companyType->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
