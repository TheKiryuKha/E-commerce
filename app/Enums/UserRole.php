<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Vendor = 'vendor';
    case Customer = 'customer';
}