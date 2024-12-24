<?php

use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Auth\Controllers\LoginSocicalController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
    Route::post('/loginApi', [AuthController::class, 'loginSubmitApi'])->name('loginSubmitApi');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerSubmit'])->name('registerSubmit');
    Route::get('/forgot-password', [AuthController::class, 'forgotPW'])->name('forgotPW');
    Route::get('/forgot-password/phone', [AuthController::class, 'forgotPWPhone'])->name('forgotPWPhone');
    Route::post('/forgot-password', [AuthController::class, 'forgotPWSubmit'])->name('forgotPWSubmit');
    Route::post('/forgot-password/phone', [AuthController::class, 'forgotPWSubmitPhone'])->name('forgotPWSubmitPhone');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPW'])->name('resetPW');
    Route::post('/reset-password/{token}', [AuthController::class, 'resetPWSubmit'])->name('resetPWSubmit');
    Route::get('/verify-phone', [AuthController::class, 'verifyPhone'])->name('verifyPhone');

    Route::post('/check-phone', [AuthController::class, 'checkPhone'])->name('checkPhone');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/change-password', [AuthController::class, 'changePW'])->name('changePW');
    Route::post('/change-password', [AuthController::class, 'changePWSubmit'])->name('changePWSubmit');
});