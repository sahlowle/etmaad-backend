<?php

namespace App\Http\Controllers\Api\Company;

use App\Actions\Tender\SubmitBidAction;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\SubmitBidRequest;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;

class CompanyTenderBidController extends BaseApiController
{
    public function submitBid(SubmitBidRequest $request, Tender $tender, SubmitBidAction $submitBidAction): JsonResponse
    {

        $submitBidAction->handle($tender, $request->validated());

        return $this->successResponse();
    }
}
