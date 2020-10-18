<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_barang', function (Blueprint $table) {
            $table->string('kode_produk_barang',15);
            $table->primary('kode_produk_barang');
            $table->string('fg_kode_produk',15)->index();
            $table->foreign('fg_kode_produk',15)->references('fg_kode_produk')->on('master_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_jual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_barang');
    }
}
