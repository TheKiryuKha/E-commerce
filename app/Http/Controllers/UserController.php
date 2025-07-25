<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Enums\UserStatus;
use App\Events\V1\UserUpdatedStatus;
use App\Http\Requests\V1\User\UpdateStatusRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\EmptyResponse;
use App\Mail\V1\BannedUserMail;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

final readonly class UserController
{
    public function updateUserStatus(UpdateStatusRequest $request, User $user): UserResource
    {
        // авторизация
        Gate::authorize('updateUserStatus', User::class);

        // обновление
        $user->update([
            'status' => $request->enum('status', UserStatus::class),
        ]);

        // уведомление(updated user(данные, сам юзер) )
        UserUpdatedStatus::dispatch($user);

        // Mail::to($user->email)->send(
        //         new BannedUserMail($user)
        //     );

        // слушатель, который в зависимости от саттуса пользователя отправит ему письмо

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return new EmptyResponse();
    }
}
