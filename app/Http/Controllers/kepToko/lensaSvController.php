<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\kepalaToko\TypeLensaSv;

use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukBarang; //2
use App\model\kepalaToko\master_produk_kacamata; //4
use App\model\kepalaToko\MasterLensaSV; //5
use App\model\kepalaToko\LensaSinggleVision; //6
class lensaSvController extends Controller
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
        $lensa=MasterLensaSV::orderBy('created_at','DESC')->paginate(20);
        $type=TypeLensaSv::get();
        return view('dashboard.kepToko.lensaSV.daftar_lensa',compact('title','lensa','type'));
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
        $lensa=MasterLensaSV::orderBy('created_at','DESC')->where('fg_kode_produk_sv','LIKE','%'.$pencarian.'%')->paginate(100);
        $type=TypeLensaSv::get();
        return view('dashboard.kepToko.lensaSV.daftar_lensa',compact('title','lensa','pencarian','type'));
    }


    public function store(Request $request)
    {

        // Algoritma  kode master produk
        $hitung_mp=MasterProduk::count();
        $tambah_1_mp=$hitung_mp+1;
        $kode_master_produk='MPLSV'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);

        // Algoritma  kode master produk
        $hitung_pb=ProdukBarang::count();
        $tambah_1_pb=$hitung_pb+1;
        $kode_produk_barang='PBV'.$tambah_1_pb.'-'.rand(0,9999);

        $table_produkBarang=new ProdukBarang;
        $table_produkBarang->kode_produk_barang=$kode_produk_barang;
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        // Algoritma  kode master produk
        $hitung_mpk=master_produk_kacamata::count();
        $tambah_1_mpk=$hitung_mpk+1;
        $kode_master_produk_kacamata='LSV'.$tambah_1_mpk.'-'.rand(0,9999);

        $table_master_produk_kacamata=new master_produk_kacamata;        
        $table_master_produk_kacamata->kode_master_produk_kacamata=$kode_master_produk_kacamata;
        $table_master_produk_kacamata->fg_kode_produk=$table_masterProduk->fg_kode_produk;

        // Master lensa
        $master_lensa=new MasterLensaSV;
        $master_lensa->fg_kode_produk_sv=$table_masterProduk->fg_kode_produk;
        $master_lensa->fg_kode_type_lensa=$request->type;
        $master_lensa->harga_jual=$table_produkBarang->harga_jual;
        $master_lensa->stok=$request->item;
        
        $lensa_sv=new LensaSinggleVision;
        $lensa_sv->kode_produk_lensa_singlevision=$table_masterProduk->fg_kode_produk;
        $lensa_sv->merk=$request->merk;
        $lensa_sv->silinder_kiri=$request->silinder_kiri;
        $lensa_sv->silinder_kanan=$request->silinder_kanan;
        $lensa_sv->lensa_kiri=$request->lensa_kiri;
        $lensa_sv->lensa_kanan=$request->lensa_kanan;
        $lensa_sv->axis=$request->axis;
        if ( $table_masterProduk->save() && $table_produkBarang->save() && $table_master_produk_kacamata->save() && $master_lensa->save() && $lensa_sv->save() )
        {
            return redirect()->back()->with('success','Penambahan Data lensa Single vision berhasil');
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
         $master_lensa=MasterLensaSV::find( $table_masterProduk->fg_kode_produk);
        $master_lensa->fg_kode_type_lensa=$request->type;
        $master_lensa->harga_jual=$table_produkBarang->harga_jual;
        $master_lensa->stok=$request->item;
        
        $lensa_sv=LensaSinggleVision::find($table_masterProduk->fg_kode_produk);
        $lensa_sv->merk=$request->merk;
        $lensa_sv->silinder_kiri=$request->silinder_kiri;
        $lensa_sv->silinder_kanan=$request->silinder_kanan;
        $lensa_sv->lensa_kiri=$request->lensa_kiri;
        $lensa_sv->lensa_kanan=$request->lensa_kanan;
        $lensa_sv->axis=$request->axis;
        if ( $table_produkBarang->save() && $master_lensa->save() && $lensa_sv->save() )
        {
            return redirect()->back()->with('success','Data lensa Single vision perbarui');
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

        return redirect()->back()->with('success','Data lensa Single vision dihapus');
    }
}
