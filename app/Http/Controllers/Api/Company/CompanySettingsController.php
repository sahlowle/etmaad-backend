<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Company\Settings\GetRequiredDocumentsRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\CompanyTypeResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\RequiredDocumentResource;
use App\Models\Activity;
use App\Models\City;
use App\Models\CompanyType;
use App\Models\Governorate;
use App\Models\Nationality;
use App\Models\RequiredDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanySettingsController extends BaseApiController
{
    public function getRequiredDocuments(GetRequiredDocumentsRequest $request): JsonResponse
    {
        $requiredDocuments = RequiredDocument::query()->where('type', $request->type)->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: RequiredDocumentResource::collection($requiredDocuments)
        );
    }

    public function getActivities(Request $request): JsonResponse
    {
        $activities = Activity::query()->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: ActivityResource::collection($activities)
        );
    }

    public function getGovernorates(Request $request): JsonResponse
    {
        $data = Governorate::query()->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: GovernorateResource::collection($data)
        );
    }

    public function getCities(Governorate $governorate): JsonResponse
    {
        $data = City::query()->where('governorate_id', $governorate->id)->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: CityResource::collection($data)
        );
    }

    public function getNationalities(Request $request): JsonResponse
    {
        $data = Nationality::query()->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: NationalityResource::collection($data)
        );
    }

    public function getCompanyTypes(Request $request): JsonResponse
    {
        $data = CompanyType::query()->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: CompanyTypeResource::collection($data)
        );
    }
}
