<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\History;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @implements WithMapping<History>
 */
final class HistoriesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return Collection<int, History>
     */
    public function collection(): Collection
    {
        return History::with(['user', 'product'])->get();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'ID',
            'User_ID',
            'Product_ID',
            'Status',
            'Time',
        ];
    }

    /**
     * @param  History  $history
     * @return array<int, int|string|null>
     */
    public function map($history): array
    {
        return [
            $history->id,
            $history->user_id,
            $history->product_id,
            $history->status->label(),
            Carbon::parse($history->time)->diffForHumans(),
        ];
    }
}
