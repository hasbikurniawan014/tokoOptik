<?php

namespace App\Http\Controllers\kepToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\model\kepalaToko\Karyawan;
use App\User;
use Image;


class karyawanController extends Controller
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

        $title="Daftar Karyawan";
        $karyawan=Karyawan::orderBy('created_at')->paginate(20);
        return view('dashboard.kepToko.karyawan.daftar_karyawan',compact('title','karyawan'));
    }

    /**
     * Mencari data karyawan 
     *
     **/
    public function pencarian(Request $request)
    {  
         $title="Hasil pencarian karyawan";
        $pencarian=$request->pencarian;
        $karyawan=Karyawan::orderBy('created_at','DESC')
                            ->join('users','users.username','karyawan.fg_karyawan')
                            ->where('nama','LIKE','%'.$pencarian.'%')->paginate(100);
        return view('dashboard.kepToko.karyawan.daftar_karyawan',compact('title','karyawan','pencarian'));
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
        $hitung_data=Karyawan::count();
        $tambah_1=$hitung_data+1;
        $generat_random_angka=rand(0,999);
        $username='KR'.$tambah_1.substr($request->tgl_lahir, 0,2).substr($request->tgl_lahir, 3,2).$generat_random_angka;

        if (Karyawan::find($username))
        {
            $generta_tambah_1=$generat_random_angka+1;
            $username='KR'.$tambah_1.substr($request->tgl_lahir, 0,2).substr($request->tgl_lahir, 3,2).$generta_tambah_1;
        }

        //Algoritma Password
        $impTanggal=implode('', explode('/', $request->tgl_lahir)) ;
        $password='karyawan#'.$impTanggal;


        //Algoritma Foto
        $file=$request->file('foto');
        $extensi=$file->getClientOriginalExtension();
        $namaFoto=time().'kr.'.$extensi;
        $lokasi=public_path('gambar/profil/karyawan/'.$namaFoto);

        $table_user =  new User;
        $table_user->username=$username;
        $table_user->nama=ucfirst($request->nama);
        $table_user->email=$request->email;
        $table_user->foto=$namaFoto;
        $table_user->password=Hash::make($password);
        $table_user->akses='2';

        $table_karyawan=new Karyawan;
        $table_karyawan->fg_karyawan=$username;
        $table_karyawan->tgl_lahir=$request->tgl_lahir;
        $table_karyawan->kelamin=$request->kelamin;
        $table_karyawan->status_karyawan='1';
        $table_karyawan->alamat=$request->alamat;
        if ($table_user && $table_karyawan) {
            Image::make($file)->save($lokasi);
            $table_user->save();
            $table_karyawan->save();

            return redirect()->back()->with('success','Data karyawan Berhasil di tambahkan ');
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
        $password='karyawan#'.$impTanggal;

        $table_user =User::find($id);
        $table_user->nama=ucfirst($request->nama);
        $table_user->email=$request->email;
        $table_user->password=Hash::make($password);


        // Algoritma Perubahan Foto
        $fotolama=$table_user->foto;
        $lokasiLama=public_path('gambar/profil/karyawan/'.$fotolama);
        if ($request->hasFile('foto')) {
            if (file_exists($lokasiLama)) {
                @unlink($lokasiLama);
            }

            $file=$request->file('foto');
            $extensi=$file->getClientOriginalExtension();
            $namaFoto=time().'kr.'.$extensi;
            $lokasi=public_path('gambar/profil/karyawan/'.$namaFoto);
            Image::make($file)->save($lokasi);
            $table_user->foto=$namaFoto;
        }

        $table_karyawan=Karyawan::find($id);
        $table_karyawan->tgl_lahir=$request->tgl_lahir;
        $table_karyawan->kelamin=$request->kelamin;
        $table_karyawan->alamat=$request->alamat;
        if ($table_user && $table_karyawan) {
            $table_user->save();
            $table_karyawan->save();

            return redirect()->back()->with('success','Data karyawan Berhasil di perbarui ');
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
        $lokasiLama=public_path('gambar/profil/karyawan/'.$fotolama);
            if (file_exists($lokasiLama)) {
                @unlink($lokasiLama);
            }
        $table_user->delete();

        return redirect()->back()->with('success','Data Karyawan berhasil di hapus !'); 
    }
}
