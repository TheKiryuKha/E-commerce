<?php

declare(strict_types=1);

use App\Http\Controllers\InvoiceController;

Route::patch('/{invoice}', [InvoiceController::class, 'update'])->name('update');
