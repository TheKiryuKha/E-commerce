<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Traits\UserFilter;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property-read int $id,
 * @property-read string $name,
 * @property-read UserRole $role,
 * @property-read UserStatus $status,
 * @property-read string $email,
 * @property-read CarbonInterface $created_at,
 * @property-read ?CarbonInterface $updated_at,
 * @property-read CarbonInterface $deleted_at,
 * @property-read Collection<int, Product> $products,
 * @property-read Collection<int, History> $history,
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read Collection<int, Invoice> $invoices,
 * @property-read Collection<int, Invoice> $purchases
 * @property-read Cart $cart
 */
final class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    use UserFilter;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => UserRole::class,
        'status' => UserStatus::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany<History, $this>
     */
    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return HasOne<Cart, $this>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasMany<Invoice, $this>
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    /**
     * @return HasMany<Invoice, $this>
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'vendor_id');
    }
}
