<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLensaSinggleVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lensa_singlevision', function (Blueprint $table) {
            $table->string('kode_produk_lensa_singlevision',15);
            $table->primary('kode_produk_lensa_singlevision');
            $table->foreign('kode_produk_lensa_singlevision')->references('fg_kode_produk_sv')->on('master_lensa_sv')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk',25);
            $table->string('ukuran_lensa',7);
            $table->string('silinder',7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lensa_singlevision');
    }
}
