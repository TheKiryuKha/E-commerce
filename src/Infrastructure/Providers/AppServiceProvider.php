<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\NewInvoice;
use App\Events\RegisteredUser;
use App\Events\UserUpdatedRole;
use App\Events\UserUpdatedStatus;
use App\Listeners\CreateCartForUser;
use App\Listeners\DeleteUserProducts;
use App\Listeners\SaveInvoiceInHistory;
use App\Listeners\SendUserStatusEmail;
use App\Listeners\SendVerificationEmail;
use Carbon\CarbonImmutable;
use Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrls();
        $this->configureDates();

        $this->configureEvents();
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    private function configureUrls(): void
    {
        URL::forceHttps(
            app()->isProduction()
        );
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureEvents(): void
    {
        Event::listen(
            RegisteredUser::class,
            CreateCartForUser::class
        );

        Event::listen(
            UserUpdatedRole::class,
            DeleteUserProducts::class
        );

        Event::listen(
            NewInvoice::class,
            SaveInvoiceInHistory::class
        );

        Event::listen(
            UserUpdatedStatus::class,
            SendUserStatusEmail::class
        );

        Event::listen(
            RegisteredUser::class,
            SendVerificationEmail::class
        );
    }
}
