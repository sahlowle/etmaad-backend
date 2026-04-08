<?php

use App\Http\Controllers\Api\Company\CompanySettingsController;
use App\Http\Controllers\Api\Company\CompanyTenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware(['auth:sanctum', 'role:company_manager|company_employee'])->group(function () {

    Route::controller(CompanyTenderController::class)->group(function () {
        Route::get('tenders', 'index');
        Route::get('tenders/{tender}', 'show');
    });

    Route::prefix('settings')->controller(CompanySettingsController::class)->group(function () {
        Route::get('required-documents', 'getRequiredDocuments');
        Route::get('activities', 'getActivities');
        Route::get('governorates', 'getGovernorates');
        Route::get('governorates/{governorate}/cities', 'getCities');
        Route::get('nationalities', 'getNationalities');
        Route::get('company-types', 'getCompanyTypes');
    });

});
