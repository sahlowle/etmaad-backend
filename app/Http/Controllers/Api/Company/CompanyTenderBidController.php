<?php

namespace App\Http\Controllers\Api\Company;

use App\Actions\Tender\SubmitBidAction;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\SubmitBidRequest;
use App\Http\Resources\CompanyBidResource;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyTenderBidController extends BaseApiController
{
    public function submitBid(SubmitBidRequest $request, Tender $tender, SubmitBidAction $submitBidAction): JsonResponse
    {

        if ($tender->isBidSubmittedBy(request()->user())) {
            return $this->errorResponse('You have already submitted a bid for this tender.');
        }
        $submitBidAction->handle($tender, $request->validated());

        return $this->successResponse();
    }

    public function index(Request $request): JsonResponse
    {
        $bids = $request->user()->company()->bids()->with('tender', 'items.tenderBoq')->paginate(10);

        return $this->paginatedResponse(CompanyBidResource::collection($bids)->resource);
    }
}
