<?php

use App\Http\Controllers\Api\Company\CompanyProfileController;
use App\Http\Controllers\Api\Company\CompanyTenderController;
use App\Http\Controllers\Api\Company\TenderBookPurchaseController;
use App\Http\Middleware\TenderPurchasedMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware(['auth:sanctum', 'role:company_manager|company_employee'])->group(function () {

    Route::controller(CompanyProfileController::class)->group(function () {
        Route::get('profile', 'show');
    });

    Route::controller(CompanyTenderController::class)->group(function () {
        Route::get('tenders', 'index');
        Route::get('tenders/{tender}', 'show');
        Route::post('tenders/{tender}/inquiries', 'submitInquiry')->middleware(TenderPurchasedMiddleware::class);
    });

    Route::controller(TenderBookPurchaseController::class)->group(function () {
        Route::post('tenders/{tender}/purchase-book', 'purchaseBook');
        Route::get('tenders/{tender}/book', 'showBook')->middleware(TenderPurchasedMiddleware::class);
        Route::get('tenders/{tender}/attachments/{attachment}/download', 'downloadBook')->middleware(TenderPurchasedMiddleware::class);
    });

});
