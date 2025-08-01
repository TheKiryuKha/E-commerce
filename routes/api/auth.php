<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SendCodeController;

Route::post('/register', RegisterController::class)->name('register');

Route::post('/send_code', SendCodeController::class)->name('send-code');

Route::post('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)
    ->middleware('auth:sanctum')
    ->name('logout');
