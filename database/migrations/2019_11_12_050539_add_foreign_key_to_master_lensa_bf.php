<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToMasterLensaBf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_lensa_bf', function (Blueprint $table) {
              $table->foreign('fg_kode_type_lensa')->references('kode_type_lensa')->on('type_lensa_sv')->onUpdate('cascade')->onDelete('cascade');
                $table->string('fg_kode_kategori_lensa',15);
                $table->foreign('fg_kode_kategori_lensa')->references('kode_kategori_lensa')->on('type_lensa_bf')->onUpdate('cascade')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_lensa_bf', function (Blueprint $table) {
            //
        });
    }
}
