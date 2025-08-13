<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\CreateUser;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\AuthCodeResponse;

final class RegisterController
{
    public function __invoke(RegisterRequest $request, CreateUser $action): AuthCodeResponse
    {
        $action->handle($request->toDto());

        return new AuthCodeResponse();
    }
}
