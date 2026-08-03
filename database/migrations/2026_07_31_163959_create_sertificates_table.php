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
        Schema::create('sertificates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name', 455);
            $table->text('description')->nullable();

            $table->unsignedInteger('position')->default(0);
            $table->string('type')->default('document');

            $table->foreignId('preview_id')->nullable()->constrained('files');
            $table->foreignId('file_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertificates');
    }
};
