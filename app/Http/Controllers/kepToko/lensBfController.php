<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\kepalaToko\TypeLensaSv;
use App\model\kepalaToko\TypeLensaBf;

use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukBarang; //2
use App\model\kepalaToko\master_produk_kacamata; //4
use App\model\kepalaToko\MasterLensaBf; //5
use App\model\kepalaToko\LensaBifokal; //6
class lensBfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    if (auth()->user()->akses == 2) {
        return  redirect()->back()->with('error','Akun tidak dikenal sebagai admin');
    }
        $title="Daftar lensa";
        $lensa=MasterLensaBf::orderBy('created_at','DESC')->paginate(20);
        $type=TypeLensaSv::get();
        $kategori=TypeLensaBf::get();
        return view('dashboard.kepToko.lensaBf.daftar_lensa',compact('title','lensa','type','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

      public function pencarian(Request $request)
    {  
        $title="Hasil pencarian Lensa SV";
        $pencarian=$request->pencarian;
        $lensa=MasterLensaBf::orderBy('created_at','DESC')->where('fg_kode_produk_bf','LIKE','%'.$pencarian.'%')->paginate(100);
        $type=TypeLensaSv::get();
        $kategori=TypeLensaBf::get();
        return view('dashboard.kepToko.lensaBf.daftar_lensa',compact('title','lensa','type','kategori','pencarian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Algoritma  kode master produk
        $hitung_mp=MasterProduk::count();
        $tambah_1_mp=$hitung_mp+1;
        $kode_master_produk='MPLBF'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);

        // Algoritma  kode master produk
        $hitung_pb=ProdukBarang::count();
        $tambah_1_pb=$hitung_pb+1;
        $kode_produk_barang='PBB'.$tambah_1_pb.'-'.rand(0,9999);

        $table_produkBarang=new ProdukBarang;
        $table_produkBarang->kode_produk_barang=$kode_produk_barang;
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        // Algoritma  kode master produk
        $hitung_mpk=master_produk_kacamata::count();
        $tambah_1_mpk=$hitung_mpk+1;
        $kode_master_produk_kacamata='LBF'.$tambah_1_mpk.'-'.rand(0,9999);

        $table_master_produk_kacamata=new master_produk_kacamata;        
        $table_master_produk_kacamata->kode_master_produk_kacamata=$kode_master_produk_kacamata;
        $table_master_produk_kacamata->fg_kode_produk=$table_masterProduk->fg_kode_produk;

        // Master lensa
        $master_lensa=new MasterLensaBf;
        $master_lensa->fg_kode_produk_bf=$table_masterProduk->fg_kode_produk;
        $master_lensa->fg_kode_type_lensa=$request->type;
        $master_lensa->fg_kode_kategori_lensa=$request->kategori;
        $master_lensa->harga_jual=$table_produkBarang->harga_jual;
        $master_lensa->stok=$request->item;
        
        $lensa_bf=new LensaBifokal;
        $lensa_bf->kode_produk_lensa=$table_masterProduk->fg_kode_produk;
        $lensa_bf->merk=$request->merk;

        $strip='-';
        $lensa_bf->lensa_kanan =$request->lensa_kanan;
        $lensa_bf->lensa_kiri =$request->lensa_kiri;
        $lensa_bf->silinder_kanan =$request->silinder_kanan;
        $lensa_bf->silinder_kiri =$request->silinder_kiri;
        $lensa_bf->axis =$request->axis;
        $lensa_bf->add =$request->add;

        if ($request->axis==null) {
            $lensa_bf->axis='-';
        }elseif($request->add == null){
            $lensa_bf->add ='-';      
        }
    
        if ( $table_masterProduk->save() && $table_produkBarang->save() && $table_master_produk_kacamata->save() && $master_lensa->save() && $lensa_bf->save() )
        {
            return redirect()->back()->with('success','Penambahan Data lensa Bifokal berhasil');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

          // Algoritma  kode master produk
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        
        $table_masterProduk=MasterProduk::find($id);
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);
        $table_masterProduk->save();

        // produk barang
        $table_produkBarang=ProdukBarang::find( $table_masterProduk->fg_kode_produk);
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        // Master lensa
        $master_lensa=MasterLensaBf::find($table_masterProduk->fg_kode_produk);
        $master_lensa->fg_kode_produk_bf=$table_masterProduk->fg_kode_produk;
        $master_lensa->fg_kode_type_lensa=$request->type;
        $master_lensa->fg_kode_kategori_lensa=$request->kategori;
        $master_lensa->harga_jual=$table_produkBarang->harga_jual;
        $master_lensa->stok=$request->item;
        
        $lensa_bf=LensaBifokal::find($table_masterProduk->fg_kode_produk);
        $lensa_bf->merk=$request->merk;

        $strip='-';
        $lensa_bf->lensa_kanan =$request->lensa_kanan;
        $lensa_bf->lensa_kiri =$request->lensa_kiri;
        $lensa_bf->silinder_kanan =$request->silinder_kanan;
        $lensa_bf->silinder_kiri =$request->silinder_kiri;

        if ($request->axis ==null) {
            return $lensa_bf->axis ='-';
        }elseif($request->add == null){
            $lensa_bf->add =$strip;      
        }else{
            $lensa_bf->axis =$request->axis;
            $lensa_bf->add =$request->add;
        }
        // return  123;
        if ( $table_produkBarang->save() && $master_lensa->save() && $lensa_bf->save() )
        {
            return redirect()->back()->with('success','Pengubahan Data lensa Bifokal berhasil');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table_masterProduk=MasterProduk::find($id);
        $table_masterProduk->delete();

        return redirect()->back()->with('success','Pengahpusan Data lensa Bifokal berhasil');
    }
}
