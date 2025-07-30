<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/{cart}', function () {
    return response(status: 201);
})->name('show');
