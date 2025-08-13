<?php

declare(strict_types=1);

namespace App\Http\Controllers\History;

use App\Exports\HistoriesExport;
use App\Models\History;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class HistoryExportController
{
    public function __invoke(): BinaryFileResponse
    {
        Gate::authorize('export', History::class);

        return Excel::download(new HistoriesExport, 'history.xlsx');
    }
}
