<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\CreateAdmin as Action;
use App\DTOs\UserDto;
use Illuminate\Console\Command;

final class CreateAdminCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:create-admin {admins=1}';

    /**
     * @var string
     */
    protected $description = 'creates admin with provided info';

    public function handle(Action $action): void
    {
        for ($i = 1; $i <= $this->argument('admins'); $i++) {
            /** @var string $name */
            $name = $this->ask("What's the {$i} admin name?", 'admin');

            /** @var string $email */
            $email = $this->ask("What's the {$i} admin email?", "test{$i}@mail.com");

            $dto = UserDto::make([
                'name' => $name,
                'email' => $email,
            ]);

            $action->handle($dto);
        }

        $this->line('All admins has been created succesfuly!');
    }
}
