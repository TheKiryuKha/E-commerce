<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Models\Traits\InvoiceFilter;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property-read int $id,
 * @property-read int $customer_id,
 * @property-read int $vendor_id,
 * @property-read int $cost,
 * @property-read string $address,
 * @property-read string $user_telephone,
 * @property-read string $user_email,
 * @property-read InvoiceStatus $status,
 * @property-read CarbonInterface $created_at,
 * @property-read CarbonInterface $updated_at
 * @property-read User $customer,
 * @property-read User $vendor,
 * @property-read Collection<int, Product> $products
 */
final class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    use InvoiceFilter;

    protected $casts = [
        'status' => InvoiceStatus::class,
    ];

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
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
