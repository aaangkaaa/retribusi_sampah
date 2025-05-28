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
        Schema::table('tr_wajib_retribusi', function (Blueprint $table) {
            $table->string('nop')->nullable()->after('npwr');
            $table->string('no_kk')->nullable()->after('nop');
            $table->integer('kwh')->nullable()->after('no_kk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_wajib_retribusi', function (Blueprint $table) {
            $table->dropColumn(['nop', 'no_kk', 'kwh']);
        });
    }
};
