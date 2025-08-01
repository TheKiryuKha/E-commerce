<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table): void {
            $table->renameColumn('user_id', 'customer_id');
            $table->unsignedBigInteger('vendor_id')->after('customer_id');
        });
    }
};
