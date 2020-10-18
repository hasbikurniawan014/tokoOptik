<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukBarang; //2
use App\model\kepalaToko\master_produk_kacamata; //4
use App\model\kepalaToko\FrameKacamata; //5

class frameController extends Controller
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
        $title="Daftar Frame";
        $frame=FrameKacamata::orderBy('created_at','DESC')->paginate(20);
        return view('dashboard.kepToko.frame.daftar_frame',compact('title','frame'));
    }
      /**
     * Mencari data frame 
     *
     **/
    public function pencarian(Request $request)
    {  
         $title="Hasil pencarian frame";
        $pencarian=$request->pencarian;
        $frame=FrameKacamata::orderBy('created_at','DESC')->where('merk','LIKE','%'.$pencarian.'%')->orWhere('kode_produk','LIKE','%'.$pencarian.'%')->paginate(100);
        return view('dashboard.kepToko.frame.daftar_frame',compact('title','frame','pencarian'));
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
        $kode_master_produk='MPB'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);

        // Algoritma  kode master produk
        $hitung_pb=ProdukBarang::count();
        $tambah_1_pb=$hitung_pb+1;
        $kode_produk_barang='PBF'.$tambah_1_pb.'-'.rand(0,9999);

        $table_produkBarang=new ProdukBarang;
        $table_produkBarang->kode_produk_barang=$kode_produk_barang;
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        // Algoritma  kode master produk
        $hitung_mpk=master_produk_kacamata::count();
        $tambah_1_mpk=$hitung_mpk+1;
        $kode_master_produk_kacamata='FR'.$tambah_1_mpk.'-'.rand(0,9999);

        $table_master_produk_kacamata=new master_produk_kacamata;        
        $table_master_produk_kacamata->kode_master_produk_kacamata=$kode_master_produk_kacamata;
        $table_master_produk_kacamata->fg_kode_produk=$table_masterProduk->fg_kode_produk;


        $table_frame=new FrameKacamata;
        $table_frame->kode_produk=$table_masterProduk->fg_kode_produk;
        $table_frame->merk=strtoupper($request->merk);
        $table_frame->harga_jual=$table_produkBarang->harga_jual;
        $table_frame->stok=$request->item;

        if ($table_masterProduk && $table_produkBarang && $table_master_produk_kacamata && $table_frame ) 
        {
            $table_masterProduk->save();
            $table_produkBarang->save();
            $table_master_produk_kacamata->save();
            $table_frame->save();

            return redirect()->back()->with('success','Data Frame Kacamata Berhasil di tambahkan');
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
        $table_masterProduk=MasterProduk::find($id);
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);
        $table_masterProduk->save();

        $table_produkBarang=ProdukBarang::find($table_masterProduk->fg_kode_produk);
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));
        

        $table_frame=FrameKacamata::find($table_masterProduk->fg_kode_produk);
        $table_frame->merk=strtoupper($request->merk);
        $table_frame->harga_jual=$table_produkBarang->harga_jual;
        $table_frame->stok=$request->item;
      
        if ($table_masterProduk && $table_frame && $table_produkBarang) {
            $table_produkBarang->save();
            $table_frame->save();

             return redirect()->back()->with('success','Data Frame Kacamata Berhasil di perbarui');
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

       // return  $table_produk=ProdukBarang::find($id);
       //  $table_produk->delete();
        return redirect()->back()->with('success','Data Frame Kacamata Berhasil di hapus');
    }
}
