<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('symbols', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name', 4)->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('symbols');
    }
};
