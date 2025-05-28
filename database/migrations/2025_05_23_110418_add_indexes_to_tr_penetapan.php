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
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->index('periode');
            $table->index('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->dropIndex(['bulan']);
            $table->dropIndex(['tahun']);
        });
    }
};
