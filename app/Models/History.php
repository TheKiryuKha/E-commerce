<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HistoryStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id,
 * @property-read int $user_id,
 * @property-read int $product_id,
 * @property-read string $status,
 * @property-read CarbonInterface $time,
 * @property-read CarbonInterface $created_at,
 * @property-read CarbonInterface $updated_at
 */
final class History extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryFactory> */
    use HasFactory;

    protected $casts = [
        'status' => HistoryStatus::class,
    ];
}
