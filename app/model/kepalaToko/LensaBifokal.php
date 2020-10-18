<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class LensaBifokal extends Model
{
    protected $table="lensa_bifokal";
    public $primaryKey="kode_produk_lensa";
    protected $keyType="string";
    public $timestamps=false;
}
