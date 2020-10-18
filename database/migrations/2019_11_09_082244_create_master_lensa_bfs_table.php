<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterLensaBfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_lensa_bf', function (Blueprint $table) {
             $table->string('fg_kode_produk_bf',15);
            $table->primary('fg_kode_produk_bf');
            $table->string('fg_kode_type_lensa',15)->index();
            $table->foreign('fg_kode_produk_bf')->references('fg_kode_produk')->on('master_produk_kacamata')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('master_lensa_bf');
    }
}
