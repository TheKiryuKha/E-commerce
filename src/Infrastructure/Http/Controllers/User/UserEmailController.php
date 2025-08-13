<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\EditUser;
use App\Http\Requests\User\UpdateEmailRequest;
use App\Http\Resources\UserResource;
use App\Queries\GetUserByCode;

final class UserEmailController
{
    public function __invoke(
        UpdateEmailRequest $request,
        GetUserByCode $query,
        EditUser $action
    ): UserResource {

        $user = $query->get(
            $request->string('code')->value()
        );

        return new UserResource(
            $action->handle($user, $request->toDto())
        );
    }
}
