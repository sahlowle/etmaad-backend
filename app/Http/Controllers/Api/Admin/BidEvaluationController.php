<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\StoreFinancialEvaluationRequest;
use App\Http\Requests\Api\Admin\StoreTechnicalEvaluationRequest;
use App\Http\Resources\BidEvaluationResource;
use App\Models\BidEvaluation;
use App\Models\Tender;
use App\Models\TenderBid;
use App\Services\BidEvaluationService;
use Illuminate\Http\JsonResponse;

class BidEvaluationController extends BaseApiController
{
    public function technicalEvaluate(StoreTechnicalEvaluationRequest $request, TenderBid $tenderBid, BidEvaluationService $service): JsonResponse
    {
        $service->techEvaluate(
            $tenderBid,
            $request->only('tech_level_1_score', 'tech_level_2_score', 'tech_level_3_score')
        );

        return $this->successResponse();
    }

    public function financialEvaluate(StoreFinancialEvaluationRequest $request, TenderBid $tenderBid, BidEvaluationService $service): JsonResponse
    {

        if (! $tenderBid->is_technical_evaluation_added) {
            return $this->errorResponse(message: api_trans('bid_evaluation.technical_evaluation_required'));
        }

        $service->finEvaluate(
            $tenderBid,
            $request->only('fin_level_1_score', 'fin_level_2_score', 'fin_level_3_score'),
        );

        return $this->successResponse();
    }

    public function index(Tender $tender): JsonResponse
    {
        $evaluations = BidEvaluation::query()
            ->with('tenderBid', 'company', 'evaluatedBy')
            ->where('tender_id', $tender->id)
            ->get();

        return $this->successResponse(
            data: BidEvaluationResource::collection($evaluations),
        );
    }
}
