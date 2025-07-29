<?php

declare(strict_types=1);

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::post('/', [ProductController::class, 'store'])->name('store');
Route::get('/{product}', [ProductController::class, 'show'])->name('show');

Route::get('/user/{user}', UserProductsController::class)->name('user:index');
