<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table='pesanan';
    public $primaryKey='kode_pesanan';
    public $keyType='string';

    /**
     * mengambil relasi pada table item pesanan sesua dengan foregnkey kode pesaanan
     *
     * @return void
     * @author 
     **/
    public function table_item_pesanan()
    {
    	return $this->hasMany('App\model\ItemPesanan','fg_kode_pesanan');
    }
}
