<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRevision2ToLensaBifokal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lensa_bifokal', function (Blueprint $table) {
            $table->renameColumn('a_lensa_kanan','lensa_kanan');
            $table->renameColumn('a_lensa_kiri','lensa_kiri');
            $table->renameColumn('b_lensa_kanan','silinder_kanan');
            $table->renameColumn('b_lensa_kiri','silinder_kiri');
            $table->renameColumn('a_silinder_kanan','axis');
            $table->renameColumn('a_silinder_kiri','add');

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
