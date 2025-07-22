<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\TokenResponse;
use App\Services\IdentityService;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $service
    ) {}

    public function __invoke(LoginRequest $request): TokenResponse
    {
        if (! $this->service->login($request->toDTO())) {
            abort(400);
        }

        return new TokenResponse(
            token: $this->service->createToken()
        );
    }
}
