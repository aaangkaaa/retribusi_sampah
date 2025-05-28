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
        Schema::table('ms_rw', function (Blueprint $table) {
            $table->dropColumn('singkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_rw', function (Blueprint $table) {
            $table->string('singkatan')->nullable()->after('nama');
        });
    }
};
