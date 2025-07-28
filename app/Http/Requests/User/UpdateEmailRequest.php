<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTOs\UserDto;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateEmailRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'code' => ['required', 'string', 'size:5', 'exists:auth_tokens,code'],
        ];
    }

    public function toDto(): UserDto
    {
        return UserDto::make([
            'email' => $this->string('email')->value(),
        ]);
    }
}
