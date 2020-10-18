<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class ProdukBarang extends Model
{
    protected $table="produk_barang";
    public $primaryKey="fg_kode_produk";
    protected $keyType="string";
    public $timestamps=false;
}
