<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\Company\CompanySettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/me', [UserController::class, 'me']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('sessions', [LoginController::class, 'sessions']);
});

Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::post('register-user', 'registerUser');
        Route::post('register-company', 'registerCompany');
        Route::post('register-agency', 'registerAgency');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
    });
});

Route::prefix('settings')->controller(CompanySettingsController::class)->group(function () {
    Route::get('required-documents', 'getRequiredDocuments');
    Route::get('activities', 'getActivities');
    Route::get('governorates', 'getGovernorates');
    Route::get('governorates/{governorate}/cities', 'getCities');
    Route::get('nationalities', 'getNationalities');
    Route::get('company-types', 'getCompanyTypes');
});

require_once __DIR__.'/api/admin.php';
require_once __DIR__.'/api/company.php';
