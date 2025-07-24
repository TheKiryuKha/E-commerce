<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('products_amount');
            $table->timestamps();
        });

        Schema::create('cart_product', function (Blueprint $table): void {
            $table->foreignIdFor(Cart::class);
            $table->foreignIdFor(Product::class);
        });
    }
};
