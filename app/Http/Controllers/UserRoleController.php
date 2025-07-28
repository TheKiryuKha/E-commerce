<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\EditUserRole;
use App\Http\Requests\User\UpdateRoleRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class UserRoleController
{
    public function __invoke(
        User $user,
        UpdateRoleRequest $request,
        EditUserRole $action
    ): UserResource {

        Gate::authorize('updateRole', $user);

        $action->handle($user, $request->toDto());

        return new UserResource($user);
    }
}
