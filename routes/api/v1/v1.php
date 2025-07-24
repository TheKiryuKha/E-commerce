<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;

Route::prefix('users')->as('users:')->controller(UserController::class)->group(
    base_path('routes/api/v1/users.php')
);
