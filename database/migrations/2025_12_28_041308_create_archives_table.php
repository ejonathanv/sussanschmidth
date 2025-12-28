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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('archiveid');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('category');
            $table->string('format');
            $table->string('status')->nullable();
            $table->string('location');
            $table->string('year');
            $table->string('height');
            $table->string('width');
            $table->string('slug');
            $table->integer('length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
