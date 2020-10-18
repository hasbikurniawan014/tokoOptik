<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTerjualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_terjual', function (Blueprint $table) {
            $table->increments('kode_barang_terjual');
            $table->string('fg_kode_penjualan',30);
            $table->foreign('fg_kode_penjualan')->references('kode_penjualan')->on('penjualan_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_master_produk',15);
            $table->string('nama_barang',25);
            $table->mediumText('keterangan')->nullable();
            $table->tinyInteger('banyak_item');
            $table->integer('total_harga_item');
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
        Schema::dropIfExists('item_terjual');
    }
}
