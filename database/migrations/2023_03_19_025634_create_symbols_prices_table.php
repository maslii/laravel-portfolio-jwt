<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('symbols_prices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('symbol_id')->constrained();
            $table->decimal('price', 20, 5)->nullable(false);
            $table->date('date')->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('symbols_prices');
    }
};
