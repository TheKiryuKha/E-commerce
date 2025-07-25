<?php

declare(strict_types=1);
use App\Http\Controllers\AdminController;

Route::delete('/{user}', 'destroy')->name('delete');

Route::controller(AdminController::class)->group(function () {

    Route::patch('/{user}/status', 'updateUserStatus')->name('updateStatus');

    Route::post('/admin', 'store')->name('admins:store');
    Route::delete('/admin/{user}', 'destroy')->name('admins:delete');
});
