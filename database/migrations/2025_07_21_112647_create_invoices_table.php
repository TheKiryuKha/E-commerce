<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('cost');
            $table->string('address');
            $table->string('user_telephone');
            $table->string('user_email');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('invoice_product', function (Blueprint $table): void {
            $table->foreignIdFor(Invoice::class);
            $table->foreignIdFor(Product::class);
        });
    }
};
