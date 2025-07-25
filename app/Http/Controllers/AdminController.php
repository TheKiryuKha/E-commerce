<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateAdmin;
use App\Actions\DeleteUser;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class AdminController
{
    public function store(RegisterRequest $request, CreateAdmin $action): UserResource
    {
        Gate::authorize('createAdmin', User::class);

        $user = $action->handle($request->toDto());

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('deleteAdmin', User::class);

        $action->handle($user);

        return new EmptyResponse();
    }
}
