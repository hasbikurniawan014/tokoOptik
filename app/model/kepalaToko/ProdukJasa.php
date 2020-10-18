<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class ProdukJasa extends Model
{
    protected $table="produk_jasa";
    public $primaryKey="kode_produk_jasa";
    protected $keyType="string";
    public $timestamps=false;
}