<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreGovernorateRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateGovernorateRequest;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;
use Illuminate\Http\JsonResponse;

class GovernorateController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $governorates = Governorate::query()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: GovernorateResource::collection($governorates)->resource
        );
    }

    public function store(StoreGovernorateRequest $request): JsonResponse
    {
        $governorate = Governorate::create($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new GovernorateResource($governorate)
        );
    }

    public function show(Governorate $governorate): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new GovernorateResource($governorate)
        );
    }

    public function update(UpdateGovernorateRequest $request, Governorate $governorate): JsonResponse
    {
        $governorate->update($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new GovernorateResource($governorate)
        );
    }

    public function destroy(Governorate $governorate): JsonResponse
    {
        $governorate->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
