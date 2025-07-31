<?php

declare(strict_types=1);

use App\Http\Controllers\InvoiceController;

Route::post('/{cart}', [InvoiceController::class, 'store'])->name('store');
Route::patch('/{invoice}', [InvoiceController::class, 'update'])->name('update');
