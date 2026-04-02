<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreNationalityRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateNationalityRequest;
use App\Http\Resources\NationalityResource;
use App\Models\Nationality;
use Illuminate\Http\JsonResponse;

class NationalityController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $nationalities = Nationality::query()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: NationalityResource::collection($nationalities)->resource
        );
    }

    public function store(StoreNationalityRequest $request): JsonResponse
    {
        $nationality = Nationality::create($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new NationalityResource($nationality)
        );
    }

    public function show(Nationality $nationality): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new NationalityResource($nationality)
        );
    }

    public function update(UpdateNationalityRequest $request, Nationality $nationality): JsonResponse
    {
        $nationality->update($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new NationalityResource($nationality)
        );
    }

    public function destroy(Nationality $nationality): JsonResponse
    {
        $nationality->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
