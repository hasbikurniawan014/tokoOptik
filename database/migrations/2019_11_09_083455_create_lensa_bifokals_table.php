    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLensaBifokalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lensa_bifokal', function (Blueprint $table) {
            $table->string('kode_produk_lensa',15);
            $table->primary('kode_produk_lensa');
            $table->foreign('kode_produk_lensa')->references('fg_kode_produk_bf')->on('master_lensa_bf')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk',25);
            $table->string('ukuran_lensa',7);
            $table->string('silinder',7);
            $table->string('ukuran_atas',7);
            $table->string('ukuran_bawah',7);
            $table->string('ukuran_atas_silinder',7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lensa_bifokal');
    }
}
