<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTOs\UserDto;
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => [
                'required',
                Rule::enum(UserRole::class)
                    ->except(UserRole::Admin),
            ],
        ];
    }

    public function toDto(): UserDto
    {
        return UserDto::make([
            'email' => $this->string('email')->toString(),
            'role' => UserRole::from($this->string('role')->value()),
        ]);
    }
}
