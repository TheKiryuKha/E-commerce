<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Events\UserUpdatedRole;
use App\Listeners\DeleteUserProducts;
use App\Models\Product;
use App\Models\User;

it("deletes user products when he stop's being vendor", function () {
    $user = User::factory()->vendor()->create();
    Product::factory(3)->for($user)->create();
    $user->update([
        'role' => UserRole::Customer,
    ]);

    $event = new UserUpdatedRole($user);
    $lister = new DeleteUserProducts();
    $lister->handle($event);

    expect($user->refresh()->products)->toBeEmpty();
});
