<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\TenderResource;
use App\Models\Tender;
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
}
