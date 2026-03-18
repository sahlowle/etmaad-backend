<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tender\CreateTenderAction;
use App\Actions\Tender\UpdateTenderAction;
use App\Http\Requests\Api\Tender\StoreTenderRequest;
use App\Http\Requests\Api\Tender\UpdateTenderRequest;
use App\Http\Resources\TenderResource;
use App\Models\Tender;
use App\Services\TenderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenderController extends BaseApiController
{
    public function index(Request $request, TenderService $tenderService): JsonResponse
    {
        $tenders = $tenderService->getAllTenders($request);

        return $this->paginatedResponse(
            paginator: TenderResource::collection($tenders)->resource,
            message: api_trans('tender.retrieved'),
        );
    }

    public function store(StoreTenderRequest $request, CreateTenderAction $action): JsonResponse
    {
        $tender = $action->handle($request->validated());

        return $this->successResponse(
            data: new TenderResource($tender),
            message: api_trans('tender.created'),
            statusCode: 201
        );
    }

    public function show(Tender $tender): JsonResponse
    {
        return $this->successResponse(
            data: new TenderResource($tender->load([
                'addressesAndDates', 'classification', 'boqs', 'attachments', 'news', 'evaluation',
            ])),
            message: api_trans('tender.retrieved'),
        );
    }

    public function update(UpdateTenderRequest $request, Tender $tender, UpdateTenderAction $action): JsonResponse
    {
        $tender = $action->handle($tender, $request->validated());

        return $this->successResponse(
            data: new TenderResource($tender),
            message: api_trans('tender.updated'),
        );
    }

    public function destroy(Tender $tender): JsonResponse
    {
        // $tender->delete();

        return $this->successResponse(
            data: null,
            message: api_trans('tender.deleted'),
        );
    }
}
