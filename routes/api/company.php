<?php

use App\Http\Controllers\Api\Company\CompanyTenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware(['auth:sanctum', 'role:company'])->group(function () {
    Route::get('tenders', [CompanyTenderController::class, 'index']);
});
