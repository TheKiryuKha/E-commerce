<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTOs\UserDto;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:15'],
        ];
    }

    public function toDto(): UserDto
    {
        return UserDto::make([
            'name' => $this->string('name')->value(),
        ]);
    }
}
