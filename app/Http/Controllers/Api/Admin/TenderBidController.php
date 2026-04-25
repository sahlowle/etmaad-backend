<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\RejectTenderBidRequest;
use App\Http\Resources\CompanyBidResource;
use App\Models\Tender;
use App\Models\TenderBid;
use App\Services\TenderBidService;
use Illuminate\Http\JsonResponse;

class TenderBidController extends BaseApiController
{
    public function index(Tender $tender): JsonResponse
    {
        $bids = $tender->bids()->with('items.tenderBoq')->paginate(10);

        return $this->paginatedResponse(CompanyBidResource::collection($bids)
            ->additional(['tender' => $tender->only('id', 'title', 'reference_number')])
            ->resource
        );
    }

    public function accept(TenderBid $tenderBid, TenderBidService $service): JsonResponse
    {
        $service->accept($tenderBid);

        return $this->successResponse();
    }

    public function reject(RejectTenderBidRequest $request, TenderBid $tenderBid, TenderBidService $service): JsonResponse
    {
        $service->reject($tenderBid, $request->validated('rejection_reason'));

        return $this->successResponse();
    }

    public function show(TenderBid $tenderBid): JsonResponse
    {
        $tenderBid->load(['items.tenderBoq', 'company:id,commercial_name,commercial_registration_number', 'tender:id,name,tender_number', 'tenderEvaluation']);

        return $this->successResponse(data: CompanyBidResource::make($tenderBid));
    }
}
