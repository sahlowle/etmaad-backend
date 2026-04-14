<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\TenderAttachmentResource;
use App\Models\Tender;
use App\Models\TenderAttachment;
use App\Services\TenderBookPurchaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenderBookPurchaseController extends BaseApiController
{
    public function purchaseBook(Request $request, Tender $tender, TenderBookPurchaseService $tenderBookPurchaseService): JsonResponse
    {
        $user = $request->user();

        if ($user->company()->hasPurchasedTender($tender)) {
            return $this->errorResponse(message: api_trans('tender.already_purchased'));
        }

        $purchase = $tenderBookPurchaseService->purchase($tender, $user, ['payment_method' => 'online']);

        return $this->successResponse(data: $purchase);
    }

    public function showBook(Tender $tender): JsonResponse
    {
        $books = $tender->attachments()->get();

        return $this->successResponse(data: TenderAttachmentResource::collection($books));
    }

    public function downloadBook(Tender $tender, TenderAttachment $attachment)
    {
        abort_if($attachment->tender_id !== $tender->id, 404);

        return Storage::disk('public_uploads')->download($attachment->file_path);
    }
}
