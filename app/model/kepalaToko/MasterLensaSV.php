<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class MasterLensaSV extends Model
{
    protected $table="master_lensa_sv";
    public $primaryKey="fg_kode_produk_sv";
    protected $keyType="string";

    /**
     * mengambil relasi antara master lensa sv dan table lensa sv untuk mengambil merk
     *
     * @author 
     **/
    public function table_lensa_sv()
    {
    	return $this->hasOne('App\model\KepalaToko\LensaSinggleVision','kode_produk_lensa_singlevision');
    }
    /**
     * mengambil relasi antra master lensa sv dan table tyhpe lensa untuk mengambil type lensa
     *
     * @author 
     **/
    public function table_type_lensa()
    {
    	return $this->hasOne('App\model\KepalaToko\TypeLensaSv','kode_type_lensa','fg_kode_type_lensa');
    }
}
