<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','nonLogin\halamanController@index')->name('nonLogin.index');
Route::post('/','nonLogin\halamanController@registrasi')->name('nonLogin.regis');

Auth::routes();

Route::middleware(['auth'])->group(function(){
	// Route Link URL Home (dashboard)
	Route::prefix('/home')->group(function(){
		Route::get('/', 'HomeController@index')->name('home');
		Route::get('/ubah-data', 'HomeController@ubah_password')->name('home.ubah');
		Route::patch('/ubah-data/{id}', 'HomeController@update_password')->name('home.update_pass');
	});

	// Route link Karyawan 
	Route::prefix('/home/karyawan')->group(function(){
		Route::get('/','kepToko\karyawanController@index')->name('karyawan.index');
		Route::post('/','kepToko\karyawanController@store')->name('karyawan.store');
		Route::put('/{id}','kepToko\karyawanController@update')->name('karyawan.update');
		Route::get('/pencarian','kepToko\karyawanController@pencarian')->name('karyawan.pencarian');
		Route::delete('/{id}','kepToko\karyawanController@destroy')->name('karyawan.destroy');
	});	

	//Route Linnk kepala toko
	Route::prefix('/home/kepToko')->group(function(){
		Route::get('/','kepToko\kepTokoController@index')->name('kepToko.index');
		Route::post('/','kepToko\kepTokoController@store')->name('kepToko.store');
		Route::put('/{id}','kepToko\kepTokoController@update')->name('kepToko.update');
		Route::get('/pencarian','kepToko\kepTokoController@pencarian')->name('kepToko.pencarian');
		Route::delete('/{id}','kepToko\kepTokoController@destroy')->name('kepToko.destroy');
	});	

	//route link frame
	Route::prefix('/home/frame')->group(function(){
		Route::get('/','kepToko\frameController@index')->name('frame.index');
		Route::post('/','kepToko\frameController@store')->name('frame.store');
		Route::put('/{id}','kepToko\frameController@update')->name('frame.update');
		Route::get('/pencarian','kepToko\frameController@pencarian')->name('frame.pencarian');
		Route::delete('/{id}','kepToko\frameController@destroy')->name('frame.destroy');
	});	


	//route link soflesnt
	Route::prefix('/home/softlens')->group(function(){
		Route::get('/','kepToko\softlensController@index')->name('softlens.index');
		Route::post('/','kepToko\softlensController@store')->name('softlens.store');
		Route::put('/{id}','kepToko\softlensController@update')->name('softlens.update');
		Route::get('/pencarian','kepToko\softlensController@pencarian')->name('softlens.pencarian');
		Route::delete('/{id}','kepToko\softlensController@destroy')->name('softlens.destroy');
	});

	//route link cleaner
	Route::prefix('/home/cleaner')->group(function(){
		Route::get('/','kepToko\cleanerController@index')->name('cleaner.index');
		Route::post('/','kepToko\cleanerController@store')->name('cleaner.store');
		Route::put('/{id}','kepToko\cleanerController@update')->name('cleaner.update');
		Route::get('/pencarian','kepToko\cleanerController@pencarian')->name('cleaner.pencarian');
		Route::delete('/{id}','kepToko\cleanerController@destroy')->name('cleaner.destroy');
	});

			//route link Type dan Kategori Lensa
	Route::prefix('/home/type-kategori-lensa')->group(function(){
		Route::get('/','kepToko\typeLensaController@index')->name('type.index');
		Route::post('/','kepToko\typeLensaController@store')->name('type.store');
		Route::put('/{id}','kepToko\typeLensaController@update')->name('type.update');
		Route::get('/pencarian','kepToko\typeLensaController@pencarian')->name('type.pencarian');
		Route::delete('/{id}','kepToko\typeLensaController@destroy')->name('type.destroy');
		
		Route::post('/bf','kepToko\typeLensaController@storebf')->name('kategori.store');
		Route::put('/bf/{id}','kepToko\typeLensaController@updatebf')->name('kategori.update');
		Route::delete('/bf/{id}','kepToko\typeLensaController@destroybf')->name('kategori.destroy');
	});

		//route link lensa SV
	Route::prefix('/home/lensa-sv')->group(function(){
		Route::get('/','kepToko\lensaSvController@index')->name('lensaSv.index');
		Route::post('/','kepToko\lensaSvController@store')->name('lensaSv.store');
		Route::put('/{id}','kepToko\lensaSvController@update')->name('lensaSv.update');
		Route::get('/pencarian','kepToko\lensaSvController@pencarian')->name('lensaSv.pencarian');
		Route::delete('/{id}','kepToko\lensaSvController@destroy')->name('lensaSv.destroy');
	});

			//route link lensa bf
	Route::prefix('/home/lensa-bf')->group(function(){
		Route::get('/','kepToko\lensBfController@index')->name('lensaBf.index');
		Route::post('/','kepToko\lensBfController@store')->name('lensaBf.store');
		Route::put('/{id}','kepToko\lensBfController@update')->name('lensaBf.update');
		Route::get('/pencarian','kepToko\lensBfController@pencarian')->name('lensaBf.pencarian');
		Route::delete('/{id}','kepToko\lensBfController@destroy')->name('lensaBf.destroy');
	});

	//route link Jasa
	Route::prefix('/home/jasa')->group(function(){
		Route::get('/','kepToko\jasaController@index')->name('jasa.index');
		Route::post('/','kepToko\jasaController@store')->name('jasa.store');
		Route::put('/{id}','kepToko\jasaController@update')->name('jasa.update');
		Route::get('/pencarian','kepToko\jasaController@pencarian')->name('jasa.pencarian');
		Route::delete('/{id}','kepToko\jasaController@destroy')->name('jasa.destroy');
		
		Route::post('/w/','kepToko\jasaController@storeWarna')->name('warna.store');
		Route::put('/w/{id}','kepToko\jasaController@updateWarna')->name('warna.update');
		Route::delete('/w/{id}','kepToko\jasaController@destroyWarna')->name('warna.destroy');
	});


	// Transaksi

		Route::prefix('/home/transaksi')->group(function(){
		Route::get('/sejarah/','kepToko\transaksiController@sejarah_transaksi')->name('transaksi.sejarah');
		Route::get('/sejarah/p','kepToko\transaksiController@pencarian')->name('transaksi.pencarian');
		Route::delete('/sejarah/{id}','kepToko\transaksiController@hapus')->name('transaksi.hapus');
		
		Route::get('/{id}','kepToko\transaksiController@index_transaksi')->name('transaksi.index');
		Route::post('/','kepToko\transaksiController@tambahTransaksi')->name('transaksi.tambahTransaksi');
		Route::post('/{id}','kepToko\transaksiController@hasil_pencarian')->name('transaksi.cari');
		Route::delete('/{id}','kepToko\transaksiController@batal_transaksi')->name('transaksi.batal');

		Route::post('/tambah-item/{id}','kepToko\transaksiController@tambah_item')->name('transaksi.tambah_item');
		Route::delete('/tambah-item/{id}','kepToko\transaksiController@hapus_item')->name('transaksi.hapus_item');
		Route::post('/tambah-item/{id_trans}/pembayaran/','kepToko\transaksiController@pembayaran')->name('transaksi.pembayaran');
		Route::get('/{id}/pdf','kepToko\transaksiController@pdf')->name('transaksi.pdf');
	});

		//route link pesanan
	Route::prefix('/home/pesanan')->group(function(){
		Route::get('/','kepToko\pesananController@index')->name('pesanan.index');
		Route::post('/','kepToko\pesananController@tambahPesanan')->name('pesanan.tambah');
		Route::put('/pembayaran/{id}','kepToko\pesananController@pembayaran')->name('pesanan.pembayaran');
		Route::put('/{id}','kepToko\pesananController@update')->name('pesanan.update');
		Route::get('/pencarian','kepToko\pesananController@pencarian')->name('pesanan.pencarian');
		Route::delete('/{id}','kepToko\pesananController@destroy')->name('pesanan.destroy');
		Route::get('/{id}/pdf','kepToko\pesananController@pdf')->name('pesanan.pdf');

		Route::get('/sejarah-pesanan','kepToko\pesananController@sejaran_pesanan')->name('pesanan.sejarah_pesanan');
		Route::get('/sejarah-pesanan/c','kepToko\pesananController@pencarian')->name('pesanan.pencarian');
		Route::delete('/sejarah-pesanan/{ifd}','kepToko\pesananController@hapus')->name('pesanan.hapus');

		Route::get('/tambah-item/{id}','kepToko\pesananController@indexItem')->name('pesanan.item');
		Route::post('/tambah-item/{id}','kepToko\pesananController@tambahItem')->name('pesanan.tambahItem');
		Route::put('/tambah-item/{id}','kepToko\pesananController@ubahItem')->name('pesanan.ubahItem');
		Route::delete('/tambah-item/{id}','kepToko\pesananController@hapusItem')->name('pesanan.hapusItem');
	});


	// route tambah stokk 
	Route::prefix('/home/stok')->group(function(){
		Route::put('/bifokal','tambahStokController@bf')->name('stok.bf');
		Route::put('/singgle-vision','tambahStokController@sv')->name('stok.sv');
		Route::put('/frame','tambahStokController@frame')->name('stok.frame');
		Route::put('/softlen','tambahStokController@softlen')->name('stok.softlen');
		Route::put('/pembersih','tambahStokController@pembersih')->name('stok.pembersih');
	});

});