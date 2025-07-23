<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\SendAuthCode;
use App\Http\Requests\Auth\VerifyRequest;
use App\Queries\GetUserByEmail;
use Illuminate\Http\JsonResponse;

final class SendCodeController
{
    public function __invoke(
        VerifyRequest $request,
        GetUserByEmail $query,
        SendAuthCode $action
    ): JsonResponse {

        $email = $request->string('email')->value();

        $action->handle($query->get($email));

        return response()->json([
            'message' => 'Link with verification code has been sent',
        ]);
    }
}
