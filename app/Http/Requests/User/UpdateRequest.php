<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTOs\UserDto;
use App\Enums\UserRole;
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
            'name' => ['sometimes', 'string', 'min:1', 'max:15'],
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
            'name' => $this->string('name')->value(),
            'role' => $this->enum('role', UserRole::class),
        ]);
    }
}
