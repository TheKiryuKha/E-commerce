<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id,
 * @property-read int $user_id,
 * @property-read int $amount,
 * @property-read int $products_amount,
 * @property-read CarbonInterface $created_at,
 * @property-read CarbonInterface $updated_at,
 * @property-read Collection $products
 */
final class Cart extends Model
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
