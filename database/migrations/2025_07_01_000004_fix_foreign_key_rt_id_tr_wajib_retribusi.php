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
            // Drop existing index on rt_id if exists
            // Use raw SQL to check if index exists before dropping
            // Since getDoctrineSchemaManager is not available, skip index drop
            // Just try to add foreign key directly
            $table->foreign('rt_id')
                ->references('id')
                ->on('ms_rt')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_wajib_retribusi', function (Blueprint $table) {
            $table->dropForeign(['rt_id']);
            $table->index('rt_id');
        });
    }
};
