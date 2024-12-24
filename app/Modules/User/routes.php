<?php

use App\Modules\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.role.admin'])->prefix('user')->as('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});
