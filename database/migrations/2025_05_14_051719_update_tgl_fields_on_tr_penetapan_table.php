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
            $table->renameColumn('tgl_pembayaran', 'tgl_penetapan');
            $table->date('tgl_tempo')->nullable()->after('tgl_penetapan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->renameColumn('tgl_penetapan', 'tgl_pembayaran');
            $table->dropColumn('tgl_tempo');
        });
    }
};
