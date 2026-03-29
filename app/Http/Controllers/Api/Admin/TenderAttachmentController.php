<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Tender\DeleteTenderAttachmentsRequest;
use App\Http\Requests\Api\Tender\UploadTenderAttachmentRequest;
use App\Http\Resources\TenderAttachmentResource;
use App\Models\Tender;
use App\Services\TenderService;
use Illuminate\Http\JsonResponse;

class TenderAttachmentController extends BaseApiController
{
    public function upload(UploadTenderAttachmentRequest $request, Tender $tender, TenderService $tenderService): JsonResponse
    {
        $attachments = $tenderService->uploadAttachments($tender, $request->validated('attachments'));

        return $this->successResponse(
            message: api_trans('success'),
            data: TenderAttachmentResource::collection($attachments),
            statusCode: 201
        );
    }

    public function destroy(DeleteTenderAttachmentsRequest $request, Tender $tender, TenderService $tenderService): JsonResponse
    {
        $tenderService->deleteAttachment($tender, $request->validated('attachments_ids'));

        return $this->successResponse(
            message: api_trans('success'),
            data: null,
        );
    }
}
