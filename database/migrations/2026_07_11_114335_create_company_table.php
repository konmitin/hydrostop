<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('full_name')->nullable();

            $table->unsignedBigInteger('inn')->nullable();
            $table->unsignedBigInteger('kpp')->nullable();
            $table->unsignedBigInteger('ogrn')->nullable();
            $table->unsignedBigInteger('okpo')->nullable();

            $table->text('legal_address')->nullable();
            $table->text('actual_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
