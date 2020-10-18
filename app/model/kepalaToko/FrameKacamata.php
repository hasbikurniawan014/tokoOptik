<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class FrameKacamata extends Model
{
    protected $table="frame_kacamata";
    public $primaryKey="kode_produk";
    protected $keyType="string";
}
