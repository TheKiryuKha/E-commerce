<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Enums\HistoryStatus;
use App\Enums\UserRole;
use App\Models\History;
use App\Models\Product;

trait UserFilter
{
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin
            && $this->tokenCan(UserRole::Admin->value);
    }

    public function isVendor(): bool
    {
        return $this->role === UserRole::Vendor
            && $this->tokenCan(UserRole::Vendor->value);
    }

    public function isDischarged(): bool
    {
        foreach ($this->invoices as $invoice) {
            if (! $invoice->isProcessed()) {
                return false;
            }
        }

        return true;
    }

    public function isViewed(Product $product): bool
    {
        return History::where('user_id', $this->id)
            ->where('product_id', $product->id)
            ->where('status', HistoryStatus::Viewed)
            ->exists();
    }
}
