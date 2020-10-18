<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Pesanan;
use App\model\PenjualanProduk;
use App\model\ItemTerjual;
use App\model\kepalaToko\ProdukBarang;

use App\model\kepalaToko\ProdukCleaner;
use App\model\kepalaToko\FrameKacamata;
use App\model\kepalaToko\MasterLensaBf;
use App\model\kepalaToko\MasterLensaSV;
use App\model\kepalaToko\ProdukSoftlens;
use App\model\kepalaToko\JasaWarna;
use App\model\kepalaToko\JasaFacet;
use PDF;

class transaksiController extends Controller
{
    /**
     * Menambahkan transaksi untuk pembelian costumer
     *
     * @author 
     **/
    public function tambahTransaksi(Request $request)
    {
    	// Algoritma kode transaksi
    	$hitung=PenjualanProduk::count();
    	$tambah_1=$hitung+1;
    	$tgl_transaksi=date('dmy');
    	$id_user=auth()->user()->username;
    	$kode_transaksi='TR'.$tambah_1.$tgl_transaksi.rand(0,999);
    	$tambahTransaksi=new PenjualanProduk;
        $tambahTransaksi->kode_penjualan=$kode_transaksi;
    	$tambahTransaksi->nama_pembeli=$request->nama_pembeli;
    	$tambahTransaksi->fg_username=$id_user;
    	$tambahTransaksi->status_pembelian=1;
    	$tambahTransaksi->save();

    	return redirect(route('transaksi.index',$kode_transaksi))->with('success','Silahkan tambahkan barang belanjaan');
    }


    /**
     * Proses memasukan data kedalam keranjang transaksi dengan kode transaksi yang sudah auto ter generate
     *
     * @return void
     * @author 
     **/
    public function index_transaksi($id)
    {	
        $data_transaksi=PenjualanProduk::find($id);
        $jasa_warna=JasaWarna::get();
    	$jasa_facet=JasaFacet::get();
    	return view('dashboard.transaksi.tambah_transaksi',compact('data_transaksi','jasa_warna','jasa_facet'));
    }

    /**
     * menmpilkan seluruh transaksi yangtelah di lakukan
     *
     * @return void
     * @author 
     **/
    public function sejarah_transaksi()
    {
        $title='Sejarah Transaksi';
        $transaksi=PenjualanProduk::orderBy('created_at','DESC')->paginate(20);
        return view('dashboard.transaksi.sejarah_transaksi',compact('title','transaksi'));
    }
    /**
     * Mencari data kode pembelian 
     *
     **/
    public function pencarian(Request $request)
    {  
        $title="Hasil pencarian kode pembelian";
        $pencarian=$request->pencarian;
        $transaksi=PenjualanProduk::orderBy('created_at','DESC')->where('kode_penjualan','LIKE','%'.$pencarian.'%')->paginate(100);
       return view('dashboard.transaksi.sejarah_transaksi',compact('title','transaksi','pencarian'));
    }

    /**
     * Menghapus data transaksi yang ada
     *
     * @return void
     * @author 
     **/
    public function hapus($id)
    {   
        $transaksi=PenjualanProduk::find($id);
        if (substr($transaksi->kode_penjualan, 0,1) == 'P') {
            if(Pesanan::find($id)) {
                $pesanan=Pesanan::find($id);
                $pesanan->delete();
            };
        }
        $transaksi->delete();
        return redirect()->back()->with('success','Data berhasil di hapus');
    }

    /**

    /**
     * Menampilkan hasil pencarian barang
     *
     * @author 
     **/
    public function hasil_pencarian(Request $request,$id)
    {
    	$pencarian=implode('' ,explode(' ', $request->cari));
    	$produk_barang=ProdukBarang::find($pencarian);
        if ($produk_barang == false) {
            return redirect()->back()->with('error','Barang tidak di temukan !, Cari berdasarkan kode produk ');
        }
        $data_transaksi=PenjualanProduk::find($id);
        $jasa_warna=JasaWarna::get();
        $jasa_facet=JasaFacet::get();
        $data_produk=substr($produk_barang->kode_produk_barang, 0,3);

        if ($data_produk == 'PBC') {
             $data_item=ProdukCleaner::find($produk_barang->fg_kode_produk);
        }else if($data_produk == 'PBF'){
             $data_item=FrameKacamata::find($produk_barang->fg_kode_produk);
        }else if($data_produk == 'PBS'){
            $data_item=ProdukSoftlens::find($produk_barang->fg_kode_produk);
        }else if ($data_produk == 'PBV') {
             $data_item=MasterLensaSV::find($produk_barang->fg_kode_produk);
        }else if ($data_produk == 'PBB') {
            $data_item=MasterLensaBf::find($produk_barang->fg_kode_produk);
        }

    	return view('dashboard.transaksi.tambah_transaksi')->with('produk_barang',$produk_barang)
    														->with('pencarian',$pencarian)
                                                            ->with('data_transaksi',$data_transaksi)
                                                            ->with('data_item',$data_item)
                                                            ->with('jasa_warna',$jasa_warna)
                                                            ->with('jasa_facet',$jasa_facet)
    														->with('data_produk',$data_produk);
    }

    /**
     * menambahkan item untuk masuk kedalam table item yang terjual
     *
     * @return void
     * @author 
     **/
    public function tambah_item(Request $request,$id)
    { 
        $item=new ItemTerjual;
        if ($request->jasa_warna) {
            $data_warna = explode('#', $request->jasa_warna);
            $item->fg_kode_penjualan=$id;
            $item->kode_master_produk=$data_warna[0];
            $item->nama_barang='-';//$data_warna[1];
            $item->total_harga_item=$data_warna[2];
            $item->banyak_item=1;
            $item->keterangan='Pewarnaan:'.$data_warna[1].'#'.$request->keterangan;
             $item->save();
            return redirect()->back()->with('success','item berhasil di tambahkan !');  
        }else 
        if($request->jasa_facet) {
            $data_facet = explode('#', $request->jasa_facet);
            $item->fg_kode_penjualan=$id;
            $item->kode_master_produk=$data_facet[0];
            $item->nama_barang='-';//$data_facet[1];
            $item->total_harga_item=$data_facet[2];
            $item->banyak_item=1;
            $item->keterangan='Facet :'. $data_facet[1].'#'.$request->keterangan;
             $item->save();
            return redirect()->back()->with('success','item berhasil di tambahkan !');  
        }

        $item->fg_kode_penjualan=$id;
        $item->kode_master_produk=$request->kode_master_produk;
        $item->nama_barang=$request->nama_barang;
        $keterangan=implode('#',array_filter($request->keterangan));
        $item->keterangan=$keterangan;
        $item->banyak_item=$request->jumlah;
        $item->jenis_produk=$request->jenis;
        $item->total_harga_item=$request->jumlah*$request->harga;
        $item->save();

        return redirect()->back()->with('success','item berhasil di tambahkan !');  
    }

    /**
     * function untuk menghandle pembayaran produk yang telah di beli 
     *
     * @return 
     * @author 
     **/
    public function pembayaran(Request $request,$id)
    {
        $hitung_data=count(array_filter($request->jenis));
         
         for ($i=0; $i < $hitung_data ; $i++) { 

             // membuat data yang bersangkutan terkurangi
            if ($request->jenis[$i] == 'PBB') {
                 $data_item=MasterLensaBf::find($request->kode_barang[$i]);
                 $data_item->stok=$data_item->stok-$request->jumlah[$i];
                 $data_item->save();
            }else if ($request->jenis[$i] == 'PBV') {
                 $data_item=MasterLensaSV::find($request->kode_barang[$i]);
                 $data_item->stok=$data_item->stok-$request->jumlah[$i];
                 $data_item->save();
            }else if ($request->jenis[$i] == 'PBS') {
                 $data_item=ProdukSoftlens::find($request->kode_barang[$i]);
                 $data_item->stok=$data_item->stok-$request->jumlah[$i];
                 $data_item->save();
            }else if ($request->jenis[$i] == 'PBF') {
                 $data_item=FrameKacamata::find($request->kode_barang[$i]);
                 $data_item->stok=$data_item->stok-$request->jumlah[$i];
                 $data_item->save();
            }else if ($request->jenis[$i] == 'PBC') {
                 $data_item=ProdukCleaner::find($request->kode_barang[$i]);
                 $data_item->stok=$data_item->stok-$request->jumlah[$i];
                 $data_item->save();
            }

        }
        $penjualan=PenjualanProduk::find($id);
        $penjualan->status_pembelian=2;
        $penjualan->save();
         return redirect()->back()->with('success','Pembayaran berhasil ! silahkan Print Nota');
    }

    /**
     * membuat file berbentuk pdf untuk dapat di print
     *
     * @return 
     * @author 
     **/
    public function pdf($id)
    {
         $data_transaksi=PenjualanProduk::find($id);
        $pdf= \PDF::loadView('dashboard.transaksi.pdf ',compact('data_transaksi'))->setPaper('a4', 'potrait');
        return $pdf->stream('nota_pembayaran', array("Attachment" => false));
    }
    /**
     * Membatalkan transaksi berarti menghapuskan transaksi yang batal di lakukan
     *
     * @return void
     * @author 
     **/
    public function batal_transaksi($id)
    {
    	$data_transaksi=PenjualanProduk::find($id);
    	$data_transaksi->delete();
    	return redirect(route('home'))->with('success','transaksi berhasil di batalkan ');
    }

    /**
     * menghapus item yang telah masuk kedalam perbelanjaan
     *
     * @return $id
     * @author 
     **/
    public function hapus_item($id)
    {   
        $data_transaksi=ItemTerjual::find($id);
        $data_transaksi->delete();
        return redirect()->back()->with('success','Item berhasil di hapus ! '); 
    }
}
