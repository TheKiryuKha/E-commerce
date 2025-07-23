<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auth_tokens', function (Blueprint $table): void {
            $table->string('code', 5)->primary();

            $table->foreignIdFor(User::class)->constrained();

            $table->timestamp('expires_at');
        });
    }
};
