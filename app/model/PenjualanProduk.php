<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PenjualanProduk extends Model
{
    protected $table="penjualan_produk";
    public $primaryKey="kode_penjualan";
    public $keyType="string";

    /**
     * mengambil data item terjual sesuai dengan kode pnjualanya
     *
     * @return 
     * @author 
     **/
    public function table_item_terjual()
    {
    	return $this->hasMany('App\model\ItemTerjual','fg_kode_penjualan','kode_penjualan');
    }
}
