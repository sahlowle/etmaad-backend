<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Company\SubmitInquiryRequest;
use App\Http\Resources\TenderResource;
use App\Http\Resources\TenderResourceDetailForCompany;
use App\Models\Tender;
use App\Services\TenderInquiryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyTenderController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $tenders = Tender::query()->published()->paginate(10);

        return $this->paginatedResponse(
            paginator: TenderResource::collection($tenders)->resource,
            message: api_trans('tender.retrieved'),
        );
    }

    public function show(Tender $tender): JsonResponse
    {

        if ($tender->isNotPublished()) {
            return $this->errorResponse(
                message: 'Not Found',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: new TenderResourceDetailForCompany($tender->load([
                'addressesAndDates', 'classification', 'boqs', 'attachments', 'news', 'evaluation',
            ])),
            message: api_trans('tender.retrieved'),
        );
    }

    public function submitInquiry(SubmitInquiryRequest $request, Tender $tender, TenderInquiryService $service): JsonResponse
    {
        $service->submit($tender, $request->user(), $request->validated('question'));

        return $this->createdResponse();
    }
}
