<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\CreateUser;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

final class RegisterController
{
    public function __invoke(RegisterRequest $request, CreateUser $action): JsonResponse
    {
        $action->handle($request->toDto());

        return response()->json([
            'message' => 'Email with verification link has been sent',
        ]);
    }
}
