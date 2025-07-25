<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Actions\EditUserStatus;
use App\Http\Requests\V1\User\UpdateStatusRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class AdminController
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
}
