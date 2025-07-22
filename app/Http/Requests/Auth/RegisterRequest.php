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
            'name' => ['required', 'string', 'min:1', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
            'role' => [
                'sometimes',
                Rule::enum(UserRole::class)
                    ->except(UserRole::Admin),
            ],
        ];
    }

    public function toDto(): UserDto
    {
        return UserDto::make([
            'name' => $this->string('name')->toString(),
            'email' => $this->string('email')->toString(),
            'password' => $this->string('password')->toString(),
            'role' => $this->enum(
                'role',
                UserRole::class,
                UserRole::Customer
            ),
        ]);
    }
}
