<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Actions\EditUser;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use App\Queries\GetUser;
use App\Queries\GetUsers;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function index(GetUsers $query): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', User::class);

        return UserResource::collection($query->get());
    }

    public function show(User $user, GetUser $query): UserResource
    {
        Gate::authorize('view', User::class);

        return new UserResource(
            $query->get($user)
        );
    }

    public function update(User $user, UpdateRequest $request, EditUser $action): UserResource
    {
        Gate::authorize('update', $user);

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
