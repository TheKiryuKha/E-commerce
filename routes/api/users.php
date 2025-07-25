<?php

declare(strict_types=1);
use App\Http\Controllers\AdminController;

Route::delete('/{user}', 'destroy')->name('delete');

Route::patch(
    '/{user}/status',
    [AdminController::class, 'updateUserStatus']
)->name('updateStatus');
