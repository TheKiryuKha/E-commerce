<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\ProductDto;
use App\Models\Product;

final readonly class EditProduct
{
    public function handle(Product $product, ProductDto $dto): void
    {
        $product->update($dto->toArray());
    }
}
