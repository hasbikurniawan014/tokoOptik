<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_jasa', function (Blueprint $table) {
            $table->string('kode_produk_jasa',15);
            $table->primary('kode_produk_jasa');
            $table->foreign('kode_produk_jasa')->references('fg_kode_produk')->on('master_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fg_kode_jasa',15)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_jasa');
    }
}
