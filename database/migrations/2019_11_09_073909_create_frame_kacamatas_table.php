<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameKacamatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_kacamata', function (Blueprint $table) {
            $table->string('kode_produk',15);
            $table->primary('kode_produk');
            $table->foreign('kode_produk')->references('fg_kode_produk')->on('master_produk_kacamata')->onUpdate('cascade')->onDelete('cascade');
            $table->string('merk',25);
            $table->integer('harga_jual');
            $table->smallInteger('stok');
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
        Schema::dropIfExists('frame_kacamata');
    }
}
