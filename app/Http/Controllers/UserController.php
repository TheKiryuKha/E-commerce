<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Actions\EditUserStatus;
use App\Http\Requests\V1\User\UpdateStatusRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function updateUserStatus(
        User $user,
        UpdateStatusRequest $request,
        EditUserStatus $action
    ): UserResource {

        Gate::authorize('updateUserStatus', User::class);

        $action->handle($user, $request->getData());

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return new EmptyResponse();
    }
}
