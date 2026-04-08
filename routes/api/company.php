<?php

use App\Http\Controllers\Api\Company\CompanyTenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware(['auth:sanctum', 'role:company_manager|company_employee'])->group(function () {

    Route::controller(CompanyTenderController::class)->group(function () {
        Route::get('tenders', 'index');
        Route::get('tenders/{tender}', 'show');
    });

});
