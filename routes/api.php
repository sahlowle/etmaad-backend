<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->headers->get('Accept');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/me', [UserController::class, 'me']);
});

Route::middleware('guest')->group(function () {
    Route::post('login', [LoginController::class, 'login']);

    Route::controller(RegisterController::class)->group(function () {
        Route::post('register-user', 'registerUser');
        Route::post('register-company', 'registerCompany');
        Route::post('register-agency', 'registerAgency');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
    });
});
