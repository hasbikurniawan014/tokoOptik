<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\kepalaToko\MasterProduk; //1
use App\model\kepalaToko\ProdukJasa; //2

use App\model\kepalaToko\JasaFacet; 
use App\model\kepalaToko\JasaWarna; 
class jasaController extends Controller
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
        $title="Daftar Jasa Facet & Pewarnaan Lensa";
        $facet=JasaFacet::orderBy('nama_facet','ASC')->paginate(20);
        $pewarnaan=JasaWarna::orderBy('warna','ASC')->paginate(20);
        return view('dashboard.kepToko.jasa.daftar_jasa',compact('title','facet','pewarnaan'));
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
        $kode_master_produk='MPJF'.$tambah_1_mp.'-'.rand(0,9999);
        $fg_kode_produk='FACET'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=$fg_kode_produk;

        // Algoritma  kode produk Jasa
        $hitung_pj=ProdukJasa::count();
        $tambah_1_pj=$hitung_pj+1;
        $kode_produk_jasa='PJF'.$tambah_1_pj.'-'.rand(0,9999);
        
        $table_produk_jasa=new ProdukJasa;
        $table_produk_jasa->kode_produk_jasa=$table_masterProduk->fg_kode_produk;
        $table_produk_jasa->fg_kode_jasa=$table_masterProduk->fg_kode_produk;


        $jasa_facet= new JasaFacet;
        $jasa_facet->kode_facet=$table_masterProduk->fg_kode_produk;
        $jasa_facet->nama_facet=strtoupper($request->facet);
        $jasa_facet->harga=implode('',explode('.', $request->harga));


        if ($table_masterProduk->save() && $table_produk_jasa->save() && $jasa_facet->save() ) {
            return redirect()->back()->with('success','Data Jasa  Facet berhasil di tambahkan');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWarna(Request $request)
    {
        // Algoritma  kode master produk
        $hitung_mp=MasterProduk::count();
        $tambah_1_mp=$hitung_mp+1;
        $kode_master_produk='MPJW'.$tambah_1_mp.'-'.rand(0,9999);
        $fg_kode_produk='WARNA'.$tambah_1_mp.'-'.rand(0,9999);
        
        $table_masterProduk=new MasterProduk;
        $table_masterProduk->kode_master_produk=$kode_master_produk;
        $kode_produk=implode('',explode(' ', $request->kode_produk));
        $table_masterProduk->fg_kode_produk=$fg_kode_produk;

        // Algoritma  kode produk Jasa
        $hitung_pj=ProdukJasa::count();
        $tambah_1_pj=$hitung_pj+1;
        $kode_produk_jasa='PJF'.$tambah_1_pj.'-'.rand(0,9999);
        
        $table_produk_jasa=new ProdukJasa;
        $table_produk_jasa->kode_produk_jasa=$table_masterProduk->fg_kode_produk;
        $table_produk_jasa->fg_kode_jasa=$table_masterProduk->fg_kode_produk;


        $jasa_warna= new JasaWarna;
        $jasa_warna->kode_warna=$table_masterProduk->fg_kode_produk;
        $jasa_warna->warna=strtoupper($request->warna);
        $jasa_warna->harga_warna=implode('',explode('.', $request->harga));


        if ($table_masterProduk->save() && $table_produk_jasa->save() && $jasa_warna->save() ) {
            return redirect()->back()->with('success','Data Jasa  Facet berhasil di tambahkan');
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
        $jasa_facet=JasaFacet::find($id);
        $jasa_facet->nama_facet=strtoupper($request->facet);
        $jasa_facet->harga=implode('',explode('.', $request->harga));
        $jasa_facet->save();

        return redirect()->back()->with('success','Data facet berhasil di perbarui');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWarna(Request $request, $id)
    {
        $jasa_warna=JasaWarna::find($id);
        $jasa_warna->warna=strtoupper($request->warna);
        $jasa_warna->harga_warna=implode('',explode('.', $request->harga));
        $jasa_warna->save();

        return redirect()->back()->with('success','Data Warna berhasil di perbarui');
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

        return redirect()->back()->with('success','Data jasa facet berhasil di hapus ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyWarna($id)
    {
        $table_warna=JasaWarna::find($id);
        $table_warna->delete();

        return redirect()->back()->with('success','Data jasa Warna berhasil di hapus ');
    }
}
