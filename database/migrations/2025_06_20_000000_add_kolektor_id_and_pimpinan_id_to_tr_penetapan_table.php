<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolektorIdAndPimpinanIdToTrPenetapanTable extends Migration
{
    public function up()
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->unsignedBigInteger('kolektor_id')->nullable()->after('id');
            $table->unsignedBigInteger('pimpinan_id')->nullable()->after('kolektor_id');

            $table->foreign('kolektor_id')->references('id')->on('kolektor')->onDelete('restrict');
            $table->foreign('pimpinan_id')->references('id')->on('pimpinan_kecamatan')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->dropForeign(['kolektor_id']);
            $table->dropForeign(['pimpinan_id']);
            $table->dropColumn(['kolektor_id', 'pimpinan_id']);
        });
    }
}
