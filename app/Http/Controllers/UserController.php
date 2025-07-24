<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Responses\EmptyResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final readonly class UserController
{
    public function destroy(User $user): EmptyResponse
    {
        Gate::authorize('delete', $user);

        $user->cart()->delete();

        $user->products()->delete();

        $user->delete();

        return new EmptyResponse();
    }
}
