<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UserController;
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

require_once __DIR__.'/api/admin.php';
require_once __DIR__.'/api/company.php';
