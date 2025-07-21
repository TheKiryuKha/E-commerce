<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;

Route::post('/login', LoginController::class)->name('login');
