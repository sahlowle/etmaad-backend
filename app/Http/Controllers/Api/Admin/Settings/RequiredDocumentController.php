<?php

namespace App\Http\Controllers\Api\Admin\Settings;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Admin\Settings\StoreRequiredDocumentRequest;
use App\Http\Requests\Api\Admin\Settings\UpdateRequiredDocumentRequest;
use App\Http\Resources\RequiredDocumentResource;
use App\Models\RequiredDocument;
use Illuminate\Http\JsonResponse;

class RequiredDocumentController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $requiredDocuments = RequiredDocument::query()->paginate(10);

        return $this->paginatedResponse(
            message: api_trans('success'),
            paginator: RequiredDocumentResource::collection($requiredDocuments)->resource
        );

    }

    public function store(StoreRequiredDocumentRequest $request): JsonResponse
    {
        $requiredDocument = RequiredDocument::create($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new RequiredDocumentResource($requiredDocument)
        );
    }

    public function show(RequiredDocument $requiredDocument): JsonResponse
    {
        return $this->successResponse(
            message: api_trans('success'),
            data: new RequiredDocumentResource($requiredDocument)
        );
    }

    public function update(UpdateRequiredDocumentRequest $request, RequiredDocument $requiredDocument): JsonResponse
    {
        $requiredDocument->update($request->validated());

        return $this->successResponse(
            message: api_trans('success'),
            data: new RequiredDocumentResource($requiredDocument)
        );
    }

    public function destroy(RequiredDocument $requiredDocument): JsonResponse
    {
        $requiredDocument->delete();

        return $this->successResponse(
            message: api_trans('success'),
        );
    }
}
