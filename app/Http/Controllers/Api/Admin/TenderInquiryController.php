<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\ReplyInquiryRequest;
use App\Http\Resources\TenderInquiryResource;
use App\Models\Tender;
use App\Models\TenderInquiry;
use App\Services\TenderInquiryService;
use Illuminate\Http\JsonResponse;

class TenderInquiryController extends BaseApiController
{
    public function index(Tender $tender): JsonResponse
    {
        $inquiries = $tender->inquiries()->with([
            'company:id,commercial_name,commercial_registration_number',
            'user:id,name,email',
            'answeredBy:id,name,email',
        ])->latest()->paginate(10);

        return $this->paginatedResponse(
            paginator: TenderInquiryResource::collection($inquiries)->resource,
        );
    }

    public function reply(ReplyInquiryRequest $request, TenderInquiry $inquiry, TenderInquiryService $tenderInquiryService): JsonResponse
    {
        $tenderInquiryService->reply($inquiry, $request->validated('answer'));

        return $this->createdResponse();
    }
}
