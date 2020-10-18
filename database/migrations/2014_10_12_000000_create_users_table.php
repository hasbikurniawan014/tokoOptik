<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username',25);//kr012015-fahmi
            $table->primary('username');
            $table->string('nama',30);
            $table->string('email',30)->unique()->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('foto',50)->nullable();
            $table->string('akses',2);
            $table->string('password',100);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
