<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
 * @property-read Collection<int, History> $history
 */
final class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $casts = [
        'status' => ProductStatus::class,
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<History, $this>
     */
    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return BelongsToMany<Invoice, $this, Pivot>
     */
    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class);
    }
}
