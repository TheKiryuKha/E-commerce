<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\ProductDto;
use App\Models\Product;
use App\Models\User;

final readonly class CreateProduct
{
    public function handle(User $user, ProductDto $dto): Product
    {
        return $user->products()->create($dto->toArray());
    }
}
