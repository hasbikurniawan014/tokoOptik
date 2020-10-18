<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class JasaWarna extends Model
{
    protected $table="jasa_warna";
    public $primaryKey="kode_warna";
    protected $keyType="string";

}

