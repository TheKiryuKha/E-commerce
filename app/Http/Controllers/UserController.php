<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Enums\UserStatus;
use App\Events\V1\UserUpdatedStatus;
use App\Http\Requests\V1\User\UpdateStatusRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function updateUserStatus(UpdateStatusRequest $request, User $user): UserResource
    {
        // авторизация
        Gate::authorize('updateUserStatus', User::class);

        $user->update([
            'status' => $request->enum('status', UserStatus::class),
        ]);

        UserUpdatedStatus::dispatch(
            $user,
            $request->string('message')->value()
        );

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return new EmptyResponse();
    }
}
