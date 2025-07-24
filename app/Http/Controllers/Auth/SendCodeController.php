<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\SendAuthCode;
use App\Http\Requests\Auth\VerifyRequest;
use App\Http\Responses\AuthCodeResponse;
use App\Queries\GetUserByEmail;

final class SendCodeController
{
    public function __invoke(
        VerifyRequest $request,
        GetUserByEmail $query,
        SendAuthCode $action
    ): AuthCodeResponse {

        $email = $request->string('email')->value();

        $action->handle($query->get($email));

        return new AuthCodeResponse();
    }
}
