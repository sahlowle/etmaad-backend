<?php

namespace App\Http\Controllers\Api\Company;

use App\Actions\Tender\SubmitBidAction;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\SubmitBidRequest;
use App\Http\Resources\CompanyBidResource;
use App\Models\Tender;
use App\Models\TenderBid;
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

        return $this->createdResponse();
    }

    public function index(Request $request): JsonResponse
    {
        $bids = $request->user()->company()->bids()->with('tender:id,name,tender_number', 'items.tenderBoq')->paginate(10);

        return $this->paginatedResponse(CompanyBidResource::collection($bids)->resource);
    }

    public function show(Tender $tender): JsonResponse
    {
        $company = auth()->user()->company();

        $bid = TenderBid::query()
            ->with('tender:id,name,tender_number', 'items.tenderBoq')
            ->where('company_id', $company->id)
            ->where('tender_id', $tender->id)
            ->first();

        if (! $bid) {
            return $this->errorResponse('Bid not found.');
        }

        return $this->successResponse(data: CompanyBidResource::make($bid));
    }
}
