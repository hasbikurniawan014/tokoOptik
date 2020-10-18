<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class TypeLensaSv extends Model
{
    protected $table="type_lensa_sv";
    public $primaryKey="kode_type_lensa";
    protected $keyType="string";
    public $timestamps=false;
}

