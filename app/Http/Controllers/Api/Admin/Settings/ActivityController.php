<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreActivityRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;

class ActivityController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $activities = Activity::query()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: ActivityResource::collection($activities)->resource
        );
    }

    public function store(StoreActivityRequest $request): JsonResponse
    {
        $activity = Activity::create($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new ActivityResource($activity)
        );
    }

    public function show(Activity $activity): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new ActivityResource($activity)
        );
    }

    public function update(UpdateActivityRequest $request, Activity $activity): JsonResponse
    {
        $activity->update($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new ActivityResource($activity)
        );
    }

    public function destroy(Activity $activity): JsonResponse
    {
        $activity->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
