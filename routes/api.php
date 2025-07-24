<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('api:')->group(function () {
    /**
     * Auth
     */
    Route::prefix('auth')->as('auth:')->group(
        base_path('routes/api/auth.php')
    );

    Route::prefix('v1')->as('v1:')->middleware('auth:sanctum')->group(
        base_path('routes/api/v1/v1.php')
    );
});
