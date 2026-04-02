<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreCityRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\JsonResponse;

class CityController extends BaseApiController
{
    public function index(Governorate $governorate): JsonResponse
    {
        $cities = $governorate->cities()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: CityResource::collection($cities)->resource
        );
    }

    public function store(StoreCityRequest $request, Governorate $governorate): JsonResponse
    {
        $city = $governorate->cities()->create($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new CityResource($city)
        );
    }

    public function show(City $city): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new CityResource($city)
        );
    }

    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $city->update($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new CityResource($city)
        );
    }

    public function destroy(City $city): JsonResponse
    {
        $city->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
