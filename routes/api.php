<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->as('api:')->group(function () {

    Route::prefix('users')->as('users:')->group(
        base_path('routes/api/users.php')
    );

    Route::prefix('products')->as('products:')->group(
        base_path('routes/api/products.php')
    );

    Route::prefix('carts')->as('carts:')->group(
        base_path('routes/api/carts.php')
    );

    Route::prefix('invoices')->as('invoices:')->group(
        base_path('routes/api/invoices.php')
    );

});

/**
 * Auth
 */
Route::prefix('auth')->as('api:auth:')->group(
    base_path('routes/api/auth.php')
);
