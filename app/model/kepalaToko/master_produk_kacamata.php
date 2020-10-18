<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class master_produk_kacamata extends Model
{
    protected $table="master_produk_kacamata";
    public $primaryKey="kd_master_produk_kacamata";
    protected $keyType="string";
    public $timestamps=false;
}
