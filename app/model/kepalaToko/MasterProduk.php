<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class MasterProduk extends Model
{
    protected $table="master_produk";
    public $primaryKey="fg_kode_produk";
    protected $keyType="string";
    public $timestamps=false;
}
