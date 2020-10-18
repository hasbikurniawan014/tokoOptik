<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class TypeLensaBf extends Model
{
    protected $table="type_lensa_bf";
    public $primaryKey="kode_kategori_lensa";
    protected $keyType="string";
    public $timestamps=false;
}
