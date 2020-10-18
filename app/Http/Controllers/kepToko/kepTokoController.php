<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\model\kepalaToko\KepalaToko;
use App\User;
use Image;
class kepTokoController extends Controller
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
        $title="Daftar kepala toko";
        $kepToko=KepalaToko::orderBy('created_at')->paginate(20);
        return view('dashboard.kepToko.kepToko.daftar_kepToko',compact('title','kepToko'));
    }

    /**
     * Mencari data kepToko 
     *
     **/
    public function pencarian(Request $request)
    {  
         $title="Hasil pencarian kepToko";
        $pencarian=$request->pencarian;
        $kepToko=KepalaToko::orderBy('created_at','DESC')
                            ->join('users','users.username','kepala_toko.fg_kepala_toko')
                            ->where('nama','LIKE','%'.$pencarian.'%')->paginate(100);
        return view('dashboard.kepToko.kepToko.daftar_kepToko',compact('title','kepToko','pencarian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Algoritma username
        $hitung_data=kepalaToko::count();
        $tambah_1=$hitung_data+1;
        $generat_random_angka=rand(0,99);
        $username='KP'.$tambah_1.substr($request->tgl_lahir, 0,2).substr($request->tgl_lahir, 3,2).$generat_random_angka;

        if (kepalaToko::find($username))
        {
            $generta_tambah_1=$generat_random_angka+1;
           $username='KP'.$tambah_1.substr($request->tgl_lahir, 0,2).substr($request->tgl_lahir, 3,2).$generta_tambah_1;
        }

        

        //Algoritma Password
        $impTanggal=implode('', explode('/', $request->tgl_lahir)) ;
        $password='miranti#'.$impTanggal;


        //Algoritma Foto
        $file=$request->file('foto');
        $extensi=$file->getClientOriginalExtension();
        $namaFoto=time().'KP.'.$extensi;
        $lokasi=public_path('gambar/profil/kepToko/'.$namaFoto);

        $table_user =  new User;
        $table_user->username=$username;
        $table_user->nama=ucfirst($request->nama);
        $table_user->email=$request->email;
        $table_user->foto=$namaFoto;
        $table_user->password=Hash::make($password);
        $table_user->akses='1';

        $table_kepala_toko=new kepalaToko;
        $table_kepala_toko->fg_kepala_toko=$username;
        $table_kepala_toko->tgl_lahir=$request->tgl_lahir;
        $table_kepala_toko->kelamin=$request->kelamin;
        $table_kepala_toko->status_kepala_toko='1';
        $table_kepala_toko->alamat=$request->alamat;
        if ($table_user && $table_kepala_toko) {
            Image::make($file)->save($lokasi);
            $table_user->save();
            $table_kepala_toko->save();

            return redirect()->back()->with('success','Data kepala toko Berhasil di tambahkan ');
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
        //Algoritma Password
        $impTanggal=implode('', explode('/', $request->tgl_lahir)) ;
        $password='miranti#'.$impTanggal;

        $table_user =  User::find($id);
        $table_user->nama=ucfirst($request->nama);
        $table_user->email=$request->email;
        $table_user->password=Hash::make($password);
        $table_user->akses='1';
   
         // Algoritma Perubahan Foto
        $fotolama=$table_user->foto;
        $lokasiLama=public_path('gambar/profil/kepToko/'.$fotolama);
        if ($request->hasFile('foto')) {
            if (file_exists($lokasiLama)) {
                @unlink($lokasiLama);
            }

            $file=$request->file('foto');
            $extensi=$file->getClientOriginalExtension();
            $namaFoto=time().'KP.'.$extensi;
            $lokasi=public_path('gambar/profil/kepToko/'.$namaFoto);
            Image::make($file)->save($lokasi);
            $table_user->foto=$namaFoto;
        }

        $table_kepala_toko=kepalaToko::find($id);
        $table_kepala_toko->tgl_lahir=$request->tgl_lahir;
        $table_kepala_toko->kelamin=$request->kelamin;
        $table_kepala_toko->status_kepala_toko='1';
        $table_kepala_toko->alamat=$request->alamat;

        if ($table_user && $table_kepala_toko) {
            $table_user->save();
            $table_kepala_toko->save();

            return redirect()->back()->with('success','Data kepala toko Berhasil di perbarui ');
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
        $table_user=User::find($id);
        $fotolama=$table_user->foto;
        $lokasiLama=public_path('gambar/profil/kepToko/'.$fotolama);
            if (file_exists($lokasiLama)) {
                @unlink($lokasiLama);
            }
        $table_user->delete();

        return redirect()->back()->with('success','Data Kepala Toko berhasil di hapus !'); 
    }
}
