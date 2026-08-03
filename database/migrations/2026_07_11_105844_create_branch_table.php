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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->default('Санкт-Петербург');
            $table->string('code')->default('sankt-peterburg');

            $table->char('is_main', 1)->default('N');

            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->text('map_link')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
