<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Company\Settings\GetRequiredDocumentsRequest;
use App\Http\Resources\RequiredDocumentResource;
use App\Models\RequiredDocument;
use Illuminate\Http\JsonResponse;

class CompanySettingsController extends BaseApiController
{
    public function getRequiredDocuments(GetRequiredDocumentsRequest $request): JsonResponse
    {
        $requiredDocuments = RequiredDocument::query()->where('type', $request->type)->get();

        return $this->successResponse(
            message: api_trans('success'),
            data: RequiredDocumentResource::collection($requiredDocuments)
        );
    }
}
