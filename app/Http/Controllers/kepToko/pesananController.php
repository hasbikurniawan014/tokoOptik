<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Pesanan;
use App\model\ItemPesanan;
use App\model\kepalaToko\TypeLensaSv;
use App\model\kepalaToko\TypeLensaBf;

use App\model\PenjualanProduk;
use App\model\ItemTerjual;
use PDF;
class pesananController extends Controller
{

     /**
     * menmpilkan seluruh transaksi yangtelah di lakukan
     *
     * @return void
     * @author 
     **/
    public function sejaran_pesanan()
    {
        $title='Sejarah pesanan';
        $pesanan=Pesanan::orderBy('created_at','DESC')->paginate(20);
        return view('dashboard.kepToko.pesanan.sejarah_pesanan',compact('title','pesanan'));
    }
    /**
     * Mencari data kode pembelian 
     *
     **/
    public function pencarian(Request $request)
    {  
        $title="Hasil pencarian kode pesanan";
        $pencarian=$request->pencarian;
        $pesanan=Pesanan::orderBy('created_at','DESC')->where('kode_pesanan','LIKE','%'.$pencarian.'%')->paginate(100);
       return view('dashboard.kepToko.pesanan.sejarah_pesanan',compact('title','pesanan','pencarian'));
    }

    /**
     * Menghapus data pesanan yang ada
     *
     * @return void
     * @author 
     **/
    public function hapus($id)
    {   
        $pesanan=Pesanan::find($id);
        $pesanan->delete();
        return redirect()->back()->with('success','Data berhasil di hapus');
    }

    /**
     * menambahkan pesanan yang masuk 
     *
     * @return void
     * @author 
     **/
    public function tambahPesanan(Request $request)
    {
        // $pesanan=implode('#', $request->pesanan);

        $hitung=Pesanan::count();
        $hitung=$hitung+1;
        $kode_pesanan='PS'.$hitung.auth()->user()->username.rand(0,999);

        $table=new Pesanan;
        $table->kode_pesanan=$kode_pesanan;
        $table->tgl_pesan=date('d-m-Y');
        $table->tgl_selesai=date('d-m-Y', strtotime('+5 days'));
        $table->status_pesanan=1;
        $table->nama_pembeli=$request->nama_pembeli;
        $table->fg_username=auth()->user()->username;
        $table->save();

        return redirect(route('pesanan.item',$kode_pesanan))->with('success','Silahkan Tambahkan pesanan barang');
    }

    /**
     * membuka page penambahan item pada pesanan yang telah di lakukan 
     *
     * @return void
     * @author 
     **/
    public function indexItem($id)
    {
        $title="Pelunasan Pesanan";

        $type=TypeLensaSv::get();
        $kategori=TypeLensaBf::get();
        $data_pesanan=Pesanan::find($id);
        return view('dashboard.kepToko.pesanan.tambah_pesanan',compact('data_pesanan','title','type','kategori'));
    }

    /**
     * menambahkan item kepada pesanan yang sedang di buka
     *
     * @return void
     * @author 
     **/
    public function tambahItem(Request $request,$id)
    {

        $cek=ItemPesanan::find(implode('',explode(' ', $request->kode_produk)));
        if ($cek) {
            return redirect()->back()->with('error','Kode produk telah di inputkan ! jika produk memiliki jumlah lebih dari 1 mohon tambahkkan pada kolom jumlah');
        }
        if ($request->jenis=='bf') {
        $keterangan=$request->kategori.'#'.$request->type.' #'.
                                    'Ukuran R :'.$request->lensa_kanan.' #'.
                                    'Ukuran L :'.$request->lensa_kiri.' #'.
                                    'CYL R :'.$request->silinder_kanan.' #'.
                                    'CYL L : '.$request->silinder_kiri.' #'.
                                    'Axis :'.$request->axis.'#'.
                                    'Add  :'.$request->add;
        }
        else if($request->jenis=="sv"){
            $keterangan=$request->type.' #'.
                        'Ukuran R :'.$request->lensa_kanan.' #'.
                        'Ukuran L :'.$request->lensa_kiri.' #'.
                        'CYL R :'.$request->silinder_kanan.' #'.
                        'CYL L : '.$request->silinder_kiri.' #'.
                        'Axis :'.$request->axis;
                        
        }elseif($request->jenis=="df"){
            $keterangan=$request->keterangan;
        }else{
            return redirect()->back()->with('error','Data tidak boleh kosong');
        }
        $table = new ItemPesanan;
        $table->fg_kode_pesanan=$id;
        $table->kode_produk=implode('',explode(' ', $request->kode_produk));
        $table->pesanan=$request->pesanan;
        $table->keterangan=$keterangan;
        $table->jumlah=$request->jumlah;
        $table->harga=implode('', explode('.', $request->harga))*$request->jumlah;
        $table->save();

        return redirect()->back()->with('success','Berhasil menambahkan pesanan item ');
    }

    /**
     * Proses pengubahan data item yang telah di inputkan pada pesanan
     *
     * @return void
     * @author 
     **/
    public function ubahItem(Request $request,$id)
    {
        $cek=ItemPesanan::find(implode('',explode(' ', $request->kode_produk)));
        // if ($cek) {
        //     return redirect()->back()->with('error','Kode produk telah di inputkan ! jika produk memiliki jumlah lebih dari 1 mohon ubah data jumlah pada kolom input jumlah');
        // }
        
        $table =ItemPesanan::find($id);
        $table->kode_produk=implode('',explode(' ', $request->kode_produk));
        $table->pesanan=$request->pesanan;
        $table->jumlah=$request->jumlah;
        $table->keterangan=$request->keterangan;
        $table->harga=implode('', explode('.', $request->harga))*$request->jumlah;
        $table->save();
        return redirect()->back()->with('success','Berhasil merubah data pesanan item ');
    }  

    /**
     * proses mengahapus data yang telah di inputkan kedalam item pesanan
     *
     * @return void
     * @author 
     **/
    public function hapusItem($id)
    {
        $table =ItemPesanan::find($id);
        $table->delete();
        return redirect()->back()->with('success','Berhasil menghapus data Item ');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Algoritma kode pesanan
        $pesanan=implode('#', $request->pesanan);
        $hitung=Pesanan::count();
        $hitung=$hitung+1;
        $kode_pesanan='PS'.$hitung.auth()->user()->username.rand(0,999);
        $table=new Pesanan;
        $table->kode_pesanan=$kode_pesanan;
        $table->tgl_pesan=$request->tgl_pesan;
        $table->tgl_selesai=$request->tgl_selesai;
        $table->pesanan=$pesanan;
        $table->uang_muka=implode('',  explode('.', $request->uang_muka));
        $table->status_pesanan=1;
        $table->fg_username=auth()->user()->username;
        $table->save();

        return redirect()->back()->with('success','Pesaanan berhasil di tambahkan');
    }

    /**
     * mengubah data status pemesanan dari angga 1 menjadi angka 2  (dp diterima)
     *
     * @return void
     * @author 
     **/
    public function update(Request $request,$id)
    {
        $table=Pesanan::find($id);
        $table->status_pesanan=2;
        $table->save();
        return redirect()->back()->with('success','Uang muka telah di terima silahkan print nota pesanan');
    }

    /**
     * membuat laporan untuk  pdf laravel
     *
     * @return void
     * @author 
     **/
    public function pdf($id)
    {

        $data_pesanan=Pesanan::find($id);
        $pdf= \PDF::loadView('dashboard.kepToko.pesanan.pdf ',compact('data_pesanan'))->setPaper('a4', 'potrait');
        return $pdf->stream('nota_pembayaran', array("Attachment" => false));
    }
    /**
     * Function untuk melakukan pembayaran terhadap barang yang telah di pesan 
     *
     * @return void
     * @author 
     **/
    public function pembayaran(Request $request,$id)
    {
        // return $request->pesanan;   
        $table=Pesanan::find($id);
        $table->status_pesanan=3;
        $table->save();

        $penjualan=new PenjualanProduk;
        $penjualan->kode_penjualan=$id;
        $penjualan->fg_username=auth()->user()->username;
        $penjualan->status_pembelian=2;
        $penjualan->nama_pembeli=$table->nama_pembeli;
        $penjualan->save();

        $jml_data=count($request->pesanan);
        for ($i=0; $i <$jml_data ; $i++)
        { 
              $item=new ItemTerjual;
              $item->fg_kode_penjualan=$id;
              $item->kode_master_produk=$request->kode_produk[$i];
              $item->nama_barang=$request->pesanan[$i];
               $item->keterangan=$request->keterangan[$i];
              $item->banyak_item=$request->jumlah[$i];
              $item->jenis_produk='KOSTUM';
              $item->total_harga_item=$request->harga[$i];
              $item->save();
        }

        return redirect(route('transaksi.index',$id))->with('success','Pembayaran pesanan berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table=Pesanan::find($id);
        $table->delete();
        return redirect(route('home'))->with('success','Pesanan berhasil di batalkan');
    }
}
