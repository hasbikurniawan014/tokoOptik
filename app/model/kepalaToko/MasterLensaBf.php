<?php

namespace App\model\KepalaToko;

use Illuminate\Database\Eloquent\Model;

class MasterLensaBf extends Model
{
    protected $table="master_lensa_bf";
    public $primaryKey="fg_kode_produk_bf";
    protected $keyType="string";


    /**
     * mengambil relasi antara master lensa sv dan table lensa sv untuk mengambil merk
     *
     * @author 
     **/
    public function table_lensa_bf()
    {
    	return $this->hasOne('App\model\KepalaToko\LensaBifokal','kode_produk_lensa');
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

    /**
     * mengambil relasi antara kategori lensa 
     *
     * @author 
     **/
    public function table_kategori_lensa()
    {
    	return $this->hasOne('App\model\KepalaToko\TypeLensaBf','kode_kategori_lensa','fg_kode_kategori_lensa');
    }
}

