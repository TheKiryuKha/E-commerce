<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Responses\EmptyResponse;
use App\Models\User;

final class LogoutController
{
    public function __invoke(): EmptyResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->tokens()->delete();

        return new EmptyResponse();
    }
}
