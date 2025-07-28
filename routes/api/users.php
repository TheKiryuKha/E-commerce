<?php

declare(strict_types=1);
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserStatusController;

Route::patch('/{user}', 'update')->name('update');
Route::delete('/{user}', 'destroy')->name('delete');

Route::patch('/{user}/status', UserStatusController::class)->name('updateStatus');
Route::patch('/{user}/role', UserRoleController::class)->name('updateRole');

Route::controller(AdminController::class)->group(function () {

    Route::post('/admin', 'store')->name('admins:store');
    Route::delete('/admin/{user}', 'destroy')->name('admins:delete');
});
