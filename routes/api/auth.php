<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)
    ->middleware('auth:sanctum')
    ->name('logout');
