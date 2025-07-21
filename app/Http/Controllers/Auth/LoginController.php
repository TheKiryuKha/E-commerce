<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthentificationFailure;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\TokenResponse;
use App\Models\User;
use App\Services\IdentityService;
use Symfony\Component\HttpFoundation\Response;

final class LoginController
{
    public function __construct(
        private readonly IdentityService $service
    ) {}

    public function __invoke(LoginRequest $request): TokenResponse
    {
        if (! $this->service->login($request->toDTO())) {
            throw new AuthentificationFailure(
                message: 'Invalid credentials',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        /** @var User $user */
        $user = auth()->user();

        return new TokenResponse(
            token: $this->service->createToken($user)
        );
    }
}
