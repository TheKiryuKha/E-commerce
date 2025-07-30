<?php

declare(strict_types=1);

namespace App\Http\Requests\Cart;

use App\Enums\ProductStatus;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CartItemRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'int',
                Rule::exists('products', 'id')->where(function (Builder $query): void {
                    $query->where('status', ProductStatus::InStock);
                }),
            ],
        ];
    }
}
