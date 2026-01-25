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
        Schema::table('small_formats', function (Blueprint $table) {
            $table->text('digital_info')->nullable()->after('length');
        });

        Schema::table('small_formats', function (Blueprint $table) {
            $table->dropColumn(['is_available', 'is_digital_print']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('small_formats', function (Blueprint $table) {
            $table->dropColumn('digital_info');
            $table->boolean('is_available')->default(false)->after('length');
            $table->boolean('is_digital_print')->default(false)->after('is_available');
        });
    }
};
