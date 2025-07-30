<?php

declare(strict_types=1);

use App\Http\Controllers\Cart\CartItemController;
use Illuminate\Support\Facades\Route;

Route::get('/{cart}', function () {
    return response(status: 201);
})->name('show');

Route::post('/{cart}/item', [CartItemController::class, 'store'])->name('item:store');
Route::delete('/{cart}/item', [CartItemController::class, 'destroy'])->name('item:destroy');
