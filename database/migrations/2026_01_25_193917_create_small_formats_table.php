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
        Schema::create('small_formats', function (Blueprint $table) {
            $table->id();
            $table->string('smallformatid');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('category');
            $table->string('format')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('year');
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('slug');
            $table->integer('length')->nullable();
            $table->boolean('is_available')->default(false);
            $table->boolean('is_digital_print')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('small_formats');
    }
};
