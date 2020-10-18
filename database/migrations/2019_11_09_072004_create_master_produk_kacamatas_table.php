<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterProdukKacamatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_produk_kacamata', function (Blueprint $table) {
            $table->string('kode_master_produk_kacamata',15);
            $table->primary('kode_master_produk_kacamata');
            $table->string('fg_kode_produk',15)->index();
            $table->foreign('fg_kode_produk')->references('fg_kode_produk')->on('produk_barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_produk_kacamata');
    }
}
