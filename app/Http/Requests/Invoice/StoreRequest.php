<?php

declare(strict_types=1);

namespace App\Http\Requests\Invoice;

use App\DTOs\InvoiceDto;
use App\Enums\UserRole;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'min:1', 'max:25'],
            'user_telephone' => ['required', 'string', 'min:5', 'max:15'],
            'vendor_id' => [
                'required',
                'int',
                Rule::exists('users', 'id')->where(function (Builder $query): void {
                    $query->where('role', UserRole::Vendor);
                }),
            ],
        ];
    }

    public function toDto(): InvoiceDto
    {
        return InvoiceDto::make([
            'address' => $this->string('address')->value(),
            'user_telephone' => $this->string('user_telephone')->value(),
            'vendor_id' => $this->integer('vendor_id'),
        ]);
    }
}
