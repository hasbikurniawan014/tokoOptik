<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepalaTokosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepala_toko', function (Blueprint $table) {
            $table->string('fg_kepala_toko',25);
            $table->primary('fg_kepala_toko');
            $table->foreign('fg_kepala_toko')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tgl_lahir',11);
            $table->string('kelamin',1);
            $table->string('status_kepala_toko',1);
            $table->mediumText('alamat');
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
        Schema::dropIfExists('kepala_toko');
    }
}
