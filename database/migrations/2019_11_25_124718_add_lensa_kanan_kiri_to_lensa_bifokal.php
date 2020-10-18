<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLensaKananKiriToLensaBifokal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lensa_bifokal', function (Blueprint $table) {
            $table->renameColumn('ukuran_lensa','a_lensa_kanan');
            $table->string('a_lensa_kiri',7);
            $table->renameColumn('ukuran_bawah','b_lensa_kanan');
            $table->string('b_lensa_kiri',7);
            $table->renameColumn('silinder','a_silinder_kanan');
            $table->string('a_silinder_kiri',7);

            $table->dropColumn('ukuran_atas');
            $table->dropColumn('ukuran_atas_silinder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lensa_bifokal', function (Blueprint $table) {
            //
        });
    }
}
