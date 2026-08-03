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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('slug', 455)->unique();

            $table->string('name');
            $table->string('description')->nullable();

            $table->string('seo_name')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();

            $table->string('sku')->nullable();
            $table->float('price');
            $table->float('count')->default(1);

            $table->float('rate')->default(5)->nullable();

            $table->foreignId('unit_id')->nullable()->constrained();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('status_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
