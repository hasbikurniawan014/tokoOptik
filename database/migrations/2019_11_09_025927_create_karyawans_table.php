<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('fg_karyawan',25);
            $table->primary('fg_karyawan');
            $table->foreign('fg_karyawan')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tgl_lahir',11);
            $table->string('kelamin',1);
            $table->string('status_karyawan',1);
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
        Schema::dropIfExists('karyawan');
    }
}
