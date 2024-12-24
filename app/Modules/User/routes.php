<?php

use App\Modules\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::
middleware(['auth'])->
prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::prefix('user')->as('user.')->group(function () {
            Route::middleware('check.role.leader')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/upgrade', [UserController::class, 'upgradeIndex'])->name('upgrade');
                Route::get('code', [UserController::class, 'code'])->name('code');
                Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
                Route::post('/transactionHistory', [UserController::class, 'transactionHistory'])->name('transactionHistory');
                Route::post('/requestWithdrawal', [UserController::class, 'requestWithdrawal'])->name('requestWithdrawal');
                Route::post('/transactionHistory/store', [UserController::class, 'transactionHistoryStore'])->name('transactionHistoryStore');
                Route::post('/confirmRequestWithdrawal', [UserController::class, 'confirmRequestWithdrawal'])->name('confirmRequestWithdrawal');
                Route::post('/cancelRequestWithdrawal', [UserController::class, 'cancelRequestWithdrawal'])->name('cancelRequestWithdrawal');
                Route::post('/store/code', [UserController::class, 'storeCode'])->name('store.code');
                Route::get('/index/code', [UserController::class, 'indexCode'])->name('index.code');
                Route::get('/edit/code/{id}', [UserController::class, 'editCode'])->name('edit.code');
                Route::put('/update/code/{id}', [UserController::class, 'updateCode'])->name('update.code');
                Route::get('/upgradeEdit/{id}', [UserController::class, 'upgradeEdit'])->name('upgradeEdit');
                Route::put('/upgradeUpdate/{id}', [UserController::class, 'upgradeUpdate'])->name('upgradeUpdate');
                Route::delete('/delete/code/{id}', [UserController::class, 'deleteCode'])->name('delete.code');
            });
            Route::middleware('check.role')->group(function () {
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
                Route::get('/get-percent/{id}', [UserController::class, 'getPercent'])->name('get-percent');
            });
            
        });
    });
