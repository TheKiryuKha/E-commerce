<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final readonly class AuthCodeResponse implements Responsable
{
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(data: [
            'message' => "Email with verification code has been sent"
        ]);
    }
}