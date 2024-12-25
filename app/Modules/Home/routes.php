<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home::index');
})->middleware('auth')->name('home.index');