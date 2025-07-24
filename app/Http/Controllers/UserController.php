<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DeleteUser;
use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function destroy(User $user, DeleteUser $action): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return new EmptyResponse();
    }
}
