<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\DeleteUser;
use App\Actions\EditUser;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use App\Queries\UserQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function index(UserQuery $query): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', User::class);

        $users = $query->get(User::query());

        return UserResource::collection($users->paginate(10));
    }

    public function show(User $user, UserQuery $query): UserResource
    {
        Gate::authorize('view', User::class);

        $user = $query->get(User::query()->where(
            'id',
            $user->id
        ));

        return new UserResource($user->first());
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
