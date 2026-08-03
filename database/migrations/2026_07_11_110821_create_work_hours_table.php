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
        Schema::create('work_hours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('branch_id')->constrained();

            $table->unsignedTinyInteger('wd_start')->default(1); // start week day number
            $table->unsignedTinyInteger('wd_end')->default(7); // end week day nubmer

            $table->time('start_at')->default(10);
            $table->time('end_at')->default(22);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_hours');
    }
};
