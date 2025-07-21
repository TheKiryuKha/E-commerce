<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id,
 * @property-read string $title,
 * @property-read string $description,
 * @property-read int $user_id,
 * @property-read int $price,
 * @property-read ProductStatus $status,
 * @property-read int $quantity,
 * @property-read CarbonInterface $created_at,
 * @property-read CarbonInterface $updated_at,
 * @property-read User $user,
 * @property-read Collection $history
 */
final class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $casts = [
        'status' => ProductStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
