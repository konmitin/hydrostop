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
        Schema::create('product_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name', 455);

            $table->unsignedInteger('position')->default(0);
            $table->string('type')->default('image'); // front | image | video | document 

            $table->foreignId('product_id')->constrained();
            $table->foreignId('file_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_files');
    }
};
