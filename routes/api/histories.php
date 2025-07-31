<?php

declare(strict_types=1);

use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\History\HistoryExportController;

Route::get('/', [HistoryController::class, 'index'])->name('index');
Route::get('/export', HistoryExportController::class)->name('export');
