<?php

use App\Http\Controllers\Api\Company\CompanySettingsController;
use App\Http\Controllers\Api\Company\CompanyTenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware(['auth:sanctum', 'role:company'])->group(function () {
    Route::get('tenders', [CompanyTenderController::class, 'index']);

    Route::prefix('settings')->controller(CompanySettingsController::class)->group(function () {
        Route::get('required-documents', 'getRequiredDocuments');
        Route::get('activities', 'getActivities');
    });

});
