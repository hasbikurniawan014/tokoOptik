<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukBarang; //2
use App\model\kepalaToko\ProdukCleaner; //3
class cleanerController extends Controller
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
          $title="Daftar Cleaner";
        $cleaner=ProdukCleaner::orderBy('created_at','DESC')->paginate(20);
        return view('dashboard.kepToko.cleaner.daftar_cleaner',compact('title','cleaner'));
    }

     public function pencarian(Request $request)
    {  
        $title="Hasil pencarian cleaner";
        $pencarian=$request->pencarian;
        $cleaner=Produkcleaner::orderBy('created_at','DESC')->where('merk','LIKE','%'.$pencarian.'%')->orWhere('kode_produk','LIKE','%'.$pencarian.'%')->paginate(100);
        return view('dashboard.kepToko.cleaner.daftar_cleaner',compact('title','cleaner','pencarian'));
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
        $kode_master_produk='MPC'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=strtoupper($kode_produk);

        // Algoritma  kode master produk
        $hitung_pb=ProdukBarang::count();
        $tambah_1_pb=$hitung_pb+1;
        $kode_produk_barang='PBC'.$tambah_1_pb.'-'.rand(0,9999);

        $table_produkBarang=new ProdukBarang;
        $table_produkBarang->kode_produk_barang=$kode_produk_barang;
        $table_produkBarang->fg_kode_produk=$table_masterProduk->fg_kode_produk;
        $table_produkBarang->harga_jual=implode('',explode('.', $request->harga_jual));

        $table_cleaner=new Produkcleaner;
        $table_cleaner->kode_produk=$table_masterProduk->fg_kode_produk;
        $table_cleaner->merk=strtoupper($request->merk);
        $table_cleaner->harga_jual=$table_produkBarang->harga_jual;
        $table_cleaner->stok=$request->item;
        $table_cleaner->jenis=$request->jenis;
        $table_cleaner->volume=$request->volume;
        $table_cleaner->periode=$request->periode;

        if ($table_masterProduk && $table_produkBarang && $table_cleaner ) 
        {
            $table_masterProduk->save();
            $table_produkBarang->save();
            $table_cleaner->save();

            return redirect()->back()->with('success','Data Cleaner Berhasil di tambahkan');
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

        $table_cleaner=Produkcleaner::find($table_masterProduk->fg_kode_produk);
        $table_cleaner->merk=strtoupper($request->merk);
        $table_cleaner->harga_jual=$table_produkBarang->harga_jual;
        $table_cleaner->stok=$request->item;
        $table_cleaner->jenis=$request->jenis;
        $table_cleaner->volume=$request->volume;
        $table_cleaner->periode=$request->periode;

        if ($table_produkBarang && $table_cleaner ) 
        {

            $table_produkBarang->save();
            $table_cleaner->save();

            return redirect()->back()->with('success','Data Cleaner Berhasil di perbarui');
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
        $table_produk=ProdukBarang::find($id);
        $table_produk->delete();

         return redirect()->back()->with('success','Data Cleaner Berhasil di hapus');
    }
}
