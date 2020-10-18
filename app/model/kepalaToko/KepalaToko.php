<?php

namespace App\model\kepalaToko;

use Illuminate\Database\Eloquent\Model;

class KepalaToko extends Model
{
    protected $table="kepala_toko";
    public $primaryKey="fg_kepala_toko";
    protected $keyType="string";

    /**
     * mengambil relasi antara kepalaToko dan users 
     *
     * @return void
     * @author 
     **/
    public function table_user()
    {
    	return $this->hasOne('App\User','username');
    }
}
