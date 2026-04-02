<?php

use App\Http\Controllers\Api\Admin\Settings\ActivityController;
use App\Http\Controllers\Api\Admin\Settings\CityController;
use App\Http\Controllers\Api\Admin\Settings\CompanyTypeController;
use App\Http\Controllers\Api\Admin\Settings\GovernorateController;
use App\Http\Controllers\Api\Admin\Settings\NationalityController;
use App\Http\Controllers\Api\Admin\Settings\RequiredDocumentController;
use App\Http\Controllers\Api\Admin\TenderAttachmentController;
use App\Http\Controllers\Api\Admin\TenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('tenders', TenderController::class);
    Route::post('tenders/{tender}/change-status', [TenderController::class, 'changeStatus']);

    Route::controller(TenderAttachmentController::class)->group(function () {
        Route::post('tenders/{tender}/attachments', 'upload');
        Route::delete('tenders/{tender}/attachments', 'destroy');
    });

    Route::prefix('settings')->group(function () {
        Route::apiResource('required-documents', RequiredDocumentController::class);
        Route::apiResource('company-types', CompanyTypeController::class);
        Route::apiResource('nationalities', NationalityController::class);
        Route::apiResource('activities', ActivityController::class);
        Route::apiResource('governorates', GovernorateController::class);
        Route::apiResource('governorates.cities', CityController::class)->shallow();
    });

});
