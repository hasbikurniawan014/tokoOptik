<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\kepalaToko\TypeLensaSv; 
use App\model\kepalaToko\TypeLensaBf; 
class typeLensaController extends Controller
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
        $title="Daftar Type & kategori lensa";
        $type=TypeLensaSv::orderBy('type_lensa','ASC')->paginate(20);
        $kategori=TypeLensaBf::orderBy('kategori','ASC')->paginate(20);
        return view('dashboard.kepToko.type.daftar_type',compact('title','type','kategori'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hitung_type=TypeLensaSv::count();
        $tambah_1=$hitung_type+1;

        $table_type=new TypeLensaSv;
        $table_type->kode_type_lensa='TY'.$tambah_1.rand(0,999);
        $table_type->type_lensa=$request->type;
        $table_type->save();

        return redirect()->back()->with('success','Data berhasil di tambahkan !');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storebf(Request $request)
    {
        $hitung_type=TypeLensaBf::count();
        $tambah_1=$hitung_type+1;

        $table_type=new TypeLensaBf;
        $table_type->kode_kategori_lensa='KT'.$tambah_1.rand(0,999);
        $table_type->kategori=$request->kategori;
        $table_type->save();

        return redirect()->back()->with('success','Data berhasil di tambahkan !');

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
        $table_type=TypeLensaSv::find($id);
        $table_type->type_lensa=$request->type;
        $table_type->save();

        return redirect()->back()->with('success','Data berhasil di Perbarui !');
    }

        public function updatebf(Request $request, $id)
    {
        $table_type=TypeLensaBf::find($id);
        $table_type->kategori=$request->kategori;
        $table_type->save();

        return redirect()->back()->with('success','Data berhasil di Perbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table_type=TypeLensaSv::find($id);
        $table_type->delete();

        return redirect()->back()->with('success','Data berhasil di Hapus !');
    }

        public function destroybf($id)
    {
        $table_type=TypeLensaBf::find($id);
        $table_type->delete();

        return redirect()->back()->with('success','Data berhasil di Hapus !');
    }
}
