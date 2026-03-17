<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tender\CreateTenderAction;
use App\Http\Requests\Api\Tender\StoreTenderRequest;
use App\Http\Resources\TenderResource;
use Illuminate\Http\JsonResponse;

class TenderController extends BaseApiController
{
    public function store(StoreTenderRequest $request, CreateTenderAction $action): JsonResponse
    {
        $tender = $action->handle($request->validated());

        return $this->successResponse(
            data: new TenderResource($tender),
            message: api_trans('tender.created'),
            statusCode: 201
        );
    }
}
