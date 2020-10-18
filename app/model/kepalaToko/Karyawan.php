<?php

namespace App\model\kepalaToko;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
     protected $table="karyawan";
    public $primaryKey="fg_karyawan";
    protected $keyType="string";

    /**
     * mengambil relasi antara karyawan dan users 
     *
     * @return void
     * @author 
     **/
    public function table_user()
    {
    	return $this->hasOne('App\User','username');
    }

}	
