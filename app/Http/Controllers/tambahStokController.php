<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\kepalaToko\FrameKacamata; //5
use App\model\kepalaToko\MasterLensaSV; 
use App\model\kepalaToko\MasterLensaBf; 
use App\model\kepalaToko\ProdukCleaner; //3
use App\model\kepalaToko\ProdukSoftlens; //3

class tambahStokController extends Controller
{
    /**
     * Menambah stok lensa bifokal
     *
     * @return void
     * @author 
     **/
    public function bf(Request $request)
    {
    	$table =MasterLensaBf::find($request->kode_produk);
    	$stok=$request->tambahStok*12;
    	$table->stok=$table->stok+$stok;
    	$table->save();
    	return redirect()->back()->with('success','Penambahan stok berhasil !');
    }

    /**
     * menambahkan stok lensa singgle vision
     *
     * @return void
     * @author 
     **/
    public function sv(Request $request)
    {
    	$table =MasterLensaSV::find($request->kode_produk);
    	$stok=$request->tambahStok*12;
    	$table->stok=$table->stok+$stok;
    	$table->save();
    	return redirect()->back()->with('success','Penambahan stok berhasil !');
    }

    /**
     * menambah stok dd kacamata
     *
     * @return void
     * @author 
     **/
    public function frame(Request $request)
    {
    	$table =FrameKacamata::find($request->kode_produk);
    	$stok=$request->tambahStok*12;
    	$table->stok=$table->stok+$stok;
    	$table->save();
    	return redirect()->back()->with('success','Penambahan stok berhasil !');
    }

    /**
     * menambah stok softlen
     *
     * @return void
     * @author 
     **/
    public function softlen(Request $request)
    {
    	$table =ProdukSoftlens::find($request->kode_produk);
    	$stok=$request->tambahStok*12;
    	$table->stok=$table->stok+$stok;
    	$table->save();
    	return redirect()->back()->with('success','Penambahan stok berhasil !');
    }


    /**
     * menambah stok pembersih 
     *
     * @return void
     * @author 
     **/
    public function pembersih(Request $request)
    {
    	$table =ProdukCleaner::find($request->kode_produk);
    	$stok=$request->tambahStok*12;
    	$table->stok=$table->stok+$stok;
    	$table->save();
    	return redirect()->back()->with('success','Penambahan stok berhasil !');
    }
}
