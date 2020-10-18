<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToLensaSinglevision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lensa_singlevision', function (Blueprint $table) {
            $table->renameColumn('silinder_kiris','silinder_kiri');
            $table->renameColumn('silinder_kanans','silinder_kanan');
            $table->renameColumn('lensa_kiris','lensa_kiri');
            $table->renameColumn('lensa_kanans','lensa_kanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lensa_singlevision', function (Blueprint $table) {
            //
        });
    }
}
