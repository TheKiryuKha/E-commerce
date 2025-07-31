<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\History;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

final class HistoriesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return History::with(['user', 'product'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Product',
            'Status',
            'Time',
        ];
    }

    public function map($history): array
    {
        return [
            $history->id,
            $history->user,
            $history->product,
            $history->status->label(),
            Carbon::parse($history->time)->diffForHumans(),
        ];
    }
}
