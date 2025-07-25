<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateStatusRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(UserStatus::class)],
            'message' => ['sometimes', 'string', 'min:1', 'max:255'],
        ];
    }

    /**
     * @return array{status: UserStatus, message: string}
     */
    public function getData(): array
    {
        return [
            'status' => UserStatus::from($this->string('status')->value()),
            'message' => $this->string('message')->value(),
        ];
    }
}
