<?php

declare(strict_types=1);

use App\Http\Controllers\History\HistoryController;

Route::get('/', [HistoryController::class, 'index'])->name('index');
