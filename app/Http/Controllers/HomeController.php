<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\model\PenjualanProduk;
use App\model\Pesanan;
use Illuminate\Support\Facades\Hash;

use App\model\kepalaToko\FrameKacamata; //5
use App\model\kepalaToko\MasterLensaSV; 
use App\model\kepalaToko\MasterLensaBf; 
use App\model\kepalaToko\ProdukCleaner; //3
use App\model\kepalaToko\ProdukSoftlens; //3
use App\model\kepalaToko\Karyawan; //3

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $frame=FrameKacamata::get();
        $typeSv=MasterLensaSV::get();
        $typeBf=MasterLensaBf::get();
        $cleaner=ProdukCleaner::get();
        $soft=ProdukSoftlens::get();
        $karyawan=Karyawan::get();

        $transaksi=PenjualanProduk::orderBy('created_at','DESC')->paginate(2);
        $pesanan=Pesanan::orderBy('created_at','DESC')->paginate(2);
        $profil=User::find(auth()->user()->username);

        return view('home',compact('transaksi','pesanan','karyawan'))
            ->with('frame',$frame)
            ->with('typeSv',$typeSv)
            ->with('typeBf',$typeBf)
            ->with('cleaner',$cleaner)
            ->with('soft',$soft)
            ->with('profil',$profil);
    }

    /**
     * Mnampilkkan data user untuk dapat merubah password saja
     *
     * @return $username
     * @author 
     **/
    public function ubah_password()
    {
        $title="Ubah password";
        return view('ubah_password')->with('title',$title);
    }

    public function update_password(Request $request,$id)
    {
        $title="Proses Update Password";
        $table=User::find($id);
        // return  $table->password.'<br>'.Hash::make($request->pass_lama);
        $check=Hash::check($request->pass_lama, $table->password);
        // return $check; 
        if ($check)
        {
            $table->password=Hash::make($request->pass_baru);
            $table->save();
            return redirect()->back()->with('success','Password Berhasil di ubah');
        }
        else
        {
             return redirect()->back()->with('error','Password lama yang anda masukan Tidak !');
        }
    }
}
