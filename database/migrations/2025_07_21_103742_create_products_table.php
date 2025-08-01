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
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('description');

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('price');
            $table->string('status');
            $table->unsignedBigInteger('quantity');
            $table->timestamps();
        });
    }
};
