<?php

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
    });

});
