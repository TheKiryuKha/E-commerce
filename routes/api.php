<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->as('api:')->group(function () {

    Route::prefix('users')->as('users:')->controller(UserController::class)->group(
        base_path('routes/api/users.php')
    );

});

/**
 * Auth
 */
Route::prefix('auth')->as('api:auth:')->group(
    base_path('routes/api/auth.php')
);
