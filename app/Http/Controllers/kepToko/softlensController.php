<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukBarang; //2
use App\model\kepalaToko\ProdukSoftlens; //3

class softlensController extends Controller
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
        $title="Daftar Softlense";
        $softlens=ProdukSoftlens::orderBy('created_at','DESC')->paginate(20);
        return view('dashboard.kepToko.softlens.daftar_softlens',compact('title','softlens'));
    }
      /**
     * Mencari data Softlens 
     *
     **/
    public function pencarian(Request $request)
    {  
        $title="Hasil pencarian softlens";
        $pencarian=$request->pencarian;
        $softlens=ProdukSoftlens::orderBy('created_at','DESC')->where('merk','LIKE','%'.$pencarian.'%')->orWhere('kode_produk','LIKE','%'.$pencarian.'%')->paginate(100);
        return view('dashboard.kepToko.softlens.daftar_softlens',compact('title','softlens','pencarian'));
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
        $kode_master_produk='MPS'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);

        // Algoritma  kode master produk
        $hitung_pb=ProdukBarang::count();
        $tambah_1_pb=$hitung_pb+1;
        $kode_produk_barang='PBS'.$tambah_1_pb.'-'.rand(0,9999);

        $table_produkBarang=new ProdukBarang;
        $table_produkBarang->kode_produk_barang=$kode_produk_barang;
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        $table_softlens=new ProdukSoftlens;
        $table_softlens->kode_produk=$table_masterProduk->fg_kode_produk;
        $table_softlens->merk=strtoupper($request->merk);
        $table_softlens->harga_jual=$table_produkBarang->harga_jual;
        $table_softlens->stok=$request->item;
        $table_softlens->warna=$request->warna;
        $table_softlens->ukuran=$request->ukuran;
        $table_softlens->periode=$request->periode;

        if ($table_masterProduk && $table_produkBarang && $table_softlens ) 
        {
            $table_masterProduk->save();
            $table_produkBarang->save();
            $table_softlens->save();

            return redirect()->back()->with('success','Data Softlens Berhasil di tambahkan');
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
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        $table_softlens=ProdukSoftlens::find($table_masterProduk->fg_kode_produk);
        $table_softlens->merk=strtoupper($request->merk);
        $table_softlens->harga_jual=implode('',explode('.', $request->harga_jual));
        $table_softlens->stok=$request->item;
        $table_softlens->warna=$request->warna;
        $table_softlens->ukuran=$request->ukuran;
        $table_softlens->periode=$request->periode;

        if ($table_masterProduk && $table_softlens ) 
        {

            $table_produkBarang->save();
            $table_softlens->save();

            return redirect()->back()->with('success','Data Softlens Berhasil di perbarui');
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

         return redirect()->back()->with('success','Data Softlens Berhasil di hapus');
    }
}
