<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_produk', function (Blueprint $table) {
            $table->string('kode_penjualan',30);
            $table->primary('kode_penjualan');
            $table->string('fg_username',25);
            $table->foreign('fg_username')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status_pembelian');
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
        Schema::dropIfExists('penjualan_produk');
    }
}
