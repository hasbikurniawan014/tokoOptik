<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJasaWarnasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_warna', function (Blueprint $table) {
            $table->string('kode_warna',15);
            $table->primary('kode_warna');
            $table->foreign('kode_warna')->references('fg_kode_jasa')->on('produk_jasa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('warna',15);
            $table->integer('harga_warna');
                  $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_warna');
    }
}
