<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTOs\UserDto;
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRoleRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', Rule::enum(UserRole::class)],
        ];
    }

    public function toDto(): UserDto
    {
        return UserDto::make([
            'role' => UserRole::from($this->string('role')->value()),
        ]);
    }
}
