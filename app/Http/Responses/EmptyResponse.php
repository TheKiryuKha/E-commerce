<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final readonly class EmptyResponse implements Responsable
{
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(status: 204);
    }
}
