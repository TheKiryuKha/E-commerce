<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\CreateToken;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\TokenResponse;
use App\Queries\GetUserByCode;

final readonly class LoginController
{
    public function __invoke(
        LoginRequest $request,
        GetUserByCode $query,
        CreateToken $action
    ): TokenResponse {

        $user = $query->get(
            $request->string('code')->value()
        );

        return new TokenResponse(
            $action->handle($user)
        );
    }
}
