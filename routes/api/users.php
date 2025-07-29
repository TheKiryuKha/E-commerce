<?php

declare(strict_types=1);

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEmailController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserStatusController;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/{user}', [UserController::class, 'show'])->name('show');
Route::patch('/{user}', [UserController::class, 'update'])->name('update');
Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete');

Route::patch('/email/update', UserEmailController::class)->name('email:update');
Route::patch('/{user}/status', UserStatusController::class)->name('status:update');
Route::patch('/{user}/role', UserRoleController::class)->name('role:update');

Route::post('/admin', [AdminController::class, 'store'])->name('admins:store');
Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admins:delete');
