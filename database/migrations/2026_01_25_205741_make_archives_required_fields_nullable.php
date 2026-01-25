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
        Schema::table('archives', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->string('format')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->string('height')->nullable()->change();
            $table->string('width')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->string('image')->change();
            $table->string('format')->change();
            $table->string('location')->change();
            $table->string('height')->change();
            $table->string('width')->change();
        });
    }
};
