`<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukSoftlensCleanersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_cleaner', function (Blueprint $table) {
            $table->string('kode_produk',15);
            $table->primary('kode_produk');
            $table->foreign('kode_produk')->references('fg_kode_produk')->on('produk_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('merk',25);
            $table->string('jenis',15);
            $table->integer('harga_jual');
            $table->smallInteger('stok');
            $table->string('volume',4);
            $table->string('periode',2);
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
        Schema::dropIfExists('produk_cleaner');
    }
}
