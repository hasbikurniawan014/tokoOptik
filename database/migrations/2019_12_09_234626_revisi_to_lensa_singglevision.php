<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisiToLensaSingglevision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lensa_singlevision', function (Blueprint $table) {
            $table->renameColumn('silinder_kanan','silinder_kiris');
            $table->renameColumn('lensa_kanan','silinder_kanans');
            $table->renameColumn('silinder_kiri','lensa_kiris');
            $table->renameColumn('lensa_kiri','lensa_kanans');
            $table->string('axis',7);
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
