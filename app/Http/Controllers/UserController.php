<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Actions\EditUser;
use App\Actions\EditUserRole;
use App\Actions\EditUserStatus;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdateRoleRequest;
use App\Http\Requests\User\UpdateStatusRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function update(User $user, UpdateRequest $request, EditUser $action): UserResource
    {
        Gate::authorize('update', $user);

        $action->handle($user, $request->toDto());

        return new UserResource($user);
    }

    public function updateStatus(
        User $user,
        UpdateStatusRequest $request,
        EditUserStatus $action
    ): UserResource {

        Gate::authorize('updateUserStatus', User::class);

        $action->handle($user, $request->getData());

        return new UserResource($user);
    }

    public function updateRole(
        User $user,
        UpdateRoleRequest $request,
        EditUserRole $action
    ): UserResource {

        Gate::authorize('updateRole', $user);

        $action->handle($user, $request->toDto());

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return new EmptyResponse();
    }
}
