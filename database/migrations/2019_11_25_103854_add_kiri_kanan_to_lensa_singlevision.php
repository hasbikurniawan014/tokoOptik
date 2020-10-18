<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKiriKananToLensaSinglevision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lensa_singlevision', function (Blueprint $table) {
            $table->renameColumn('ukuran_lensa','lensa_kiri');
            $table->string('lensa_kanan',7);
            $table->renameColumn('silinder','silinder_kiri');
            $table->string('silinder_kanan',7);
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
