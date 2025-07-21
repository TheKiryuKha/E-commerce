<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTOs\UserDto;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:25'],
        ];
    }

    public function toDTO(): UserDto
    {
        return UserDto::make([
            'email' => $this->string('email')->toString(),
            'password' => $this->string('password')->toString(),
        ]);
    }
}
