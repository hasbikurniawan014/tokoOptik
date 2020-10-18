<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItemPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_item');
            $table->string('fg_kode_pesanan',30)->index();
            $table->foreign('fg_kode_pesanan')->references('kode_pesanan')->on('pesanan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_produk',15);
            $table->string('pesanan',55);
            $table->smallInteger('jumlah');
            $table->mediumText('keterangan')->nullable();
            $table->integer('harga');
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
        Schema::dropIfExists('item_pesanan');
    }
}
