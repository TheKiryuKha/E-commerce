<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property-read int $id,
 * @property-read int $user_id,
 * @property-read int $amount,
 * @property-read int $products_amount,
 * @property-read CarbonInterface $created_at,
 * @property-read CarbonInterface $updated_at,
 * @property-read Collection<int, Product> $products
 * @property-read User $user
 */
final class Cart extends Model
{
    /**
     * @return BelongsToMany<Product, $this, Pivot>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
