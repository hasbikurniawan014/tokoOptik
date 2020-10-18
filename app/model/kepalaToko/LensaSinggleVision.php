<?php

namespace App\model\kepalaToko;

use Illuminate\Database\Eloquent\Model;

class LensaSinggleVision extends Model
{
    protected $table="lensa_singlevision";
    public $primaryKey="kode_produk_lensa_singlevision";
    protected $keyType="string";
    public $timestamps=false;
}
