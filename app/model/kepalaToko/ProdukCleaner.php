<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class ProdukCleaner extends Model
{
    protected $table="produk_cleaner";
    public $primaryKey="kode_produk";
    protected $keyType="string";
}
