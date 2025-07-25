<?php

declare(strict_types=1);
use App\Http\Controllers\AdminController;

Route::delete('/{user}', 'destroy')->name('delete');

Route::patch('/{user}/status', 'updateStatus')->name('updateStatus');

Route::controller(AdminController::class)->group(function () {

    Route::post('/admin', 'store')->name('admins:store');
    Route::delete('/admin/{user}', 'destroy')->name('admins:delete');
});
