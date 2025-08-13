<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\DTOs\ProductDto;
use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:10'],
            'description' => ['required', 'string', 'min:1', 'max:255'],
            'price' => ['required', 'int', 'min:1', 'max:650000'],
            'status' => ['required', Rule::enum(ProductStatus::class)],
            'quantity' => ['required', 'int', 'min:0', 'max:650000'],
        ];
    }

    public function toDto(): ProductDto
    {
        return ProductDto::make([
            'title' => $this->string('title')->value(),
            'description' => $this->string('description')->value(),
            'price' => $this->integer('price'),
            'status' => ProductStatus::from($this->string('status')->value()),
            'quantity' => $this->integer('quantity'),
        ]);
    }
}
