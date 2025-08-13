<?php

declare(strict_types=1);

namespace App\Http\Requests\Invoice;

use App\DTOs\InvoiceDto;
use App\Enums\InvoiceStatus;
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
            'status' => ['required', Rule::enum(InvoiceStatus::class)],
        ];
    }

    public function toDto(): InvoiceDto
    {
        return InvoiceDto::make([
            'status' => InvoiceStatus::from($this->string('status')->value()),
        ]);
    }
}
