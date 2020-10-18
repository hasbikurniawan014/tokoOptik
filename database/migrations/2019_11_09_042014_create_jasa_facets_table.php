<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJasaFacetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_facet', function (Blueprint $table) {
            $table->string('kode_facet',15);
            $table->primary('kode_facet',15);
            $table->foreign('kode_facet')->references('fg_kode_jasa')->on('produk_jasa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_facet',25);
            $table->string('jenis',10);
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
        Schema::dropIfExists('jasa_facet');
    }
}
