<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/vote', [App\Http\Controllers\HomeController::class, 'store'])->name('vote');
