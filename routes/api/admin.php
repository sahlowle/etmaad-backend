<?php

use App\Http\Controllers\Api\Admin\CompanyController;
use App\Http\Controllers\Api\Admin\Settings\ActivityController;
use App\Http\Controllers\Api\Admin\Settings\CityController;
use App\Http\Controllers\Api\Admin\Settings\CompanyTypeController;
use App\Http\Controllers\Api\Admin\Settings\GovernorateController;
use App\Http\Controllers\Api\Admin\Settings\NationalityController;
use App\Http\Controllers\Api\Admin\Settings\RequiredDocumentController;
use App\Http\Controllers\Api\Admin\TenderAttachmentController;
use App\Http\Controllers\Api\Admin\TenderController;
use App\Http\Controllers\Api\Admin\TenderInquiryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('tenders', TenderController::class);
    Route::post('tenders/{tender}/change-status', [TenderController::class, 'changeStatus']);
    Route::get('tenders/{tender}/inquiries', [TenderInquiryController::class, 'index']);
    Route::post('inquiries/{inquiry}/reply', [TenderInquiryController::class, 'reply']);

    Route::controller(TenderAttachmentController::class)->group(function () {
        Route::post('tenders/{tender}/attachments', 'upload');
        Route::delete('tenders/{tender}/attachments', 'destroy');
    });

    Route::controller(CompanyController::class)->prefix('companies')->group(function () {
        Route::get('/', 'index');
        Route::get('list-statuses', 'getStatuses');
        Route::get('insights', 'getInsights');
        Route::get('{company}', 'show')->whereNumber('company');
        Route::post('{company}/change-status', 'changeStatus')->whereNumber('company');
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
