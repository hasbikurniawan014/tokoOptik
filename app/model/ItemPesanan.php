<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
      protected $table='item_pesanan';
      public $primaryKey='kode_produk';
      public $keyType='string';
}
