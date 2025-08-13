<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductStatus: string
{
    case InStock = 'inStock';
    case NotAvaileble = 'NotAvaileble';
}
