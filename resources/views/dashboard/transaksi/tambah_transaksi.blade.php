@extends('layouts.app')
@section('content')
<h4>Transaksi Barang </h4>
<p class="font-weight-bold">Pelanggan : {{$data_transaksi->nama_pembeli}}</p>
<hr>
@if($data_transaksi->status_pembelian == 2)

<a href="{{route('home')}}"  class="p-2"><i class="fa fa-arrow-left mr-2"></i> Kembali</a>
	<h5 class="p-2"><i class="fa fa-shopping-basket mr-2 text-success"></i>Daftar Belanjaan</h5>
	<table class="table table-sm table-light table-hover table-striped">
		<tr>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Total Harga</th>
			<th>Keterangan</th>
		</tr>
		@foreach($data_transaksi->table_item_terjual as $item)	
			<tr>
				<td class="align-middle"><small>{{$item->kode_master_produk}}</small></td>
				<td class="align-middle">{{$item->nama_barang}}</td>
				<td class="align-middle">
					Rp
					<span class="harga">{{$item->total_harga_item / $item->banyak_item}}</span>
				</td>
				<td class="align-middle">{{$item->banyak_item}}</td>
				<td class="align-middle">
					Rp
					<span class="harga">{{$item->total_harga_item}}</span>
				</td>
				<td>
					<?php $data_ket=explode('#', $item->keterangan) ?>
					@foreach($data_ket as $ket)
						<span class="p-1` rounded border border m-1" style="display: inline-block;">{{$ket}}</span>
					@endforeach
				</td>
			</tr>

		@endforeach
	</table>
	<hr>
	<div class="row">
		<div class="col-sm">
			<h4>Total Pembayaran :</h4>
			<h4>Rp <span class="harga">{{$data_transaksi->table_item_terjual->where('fg_kode_penjualan',$data_transaksi->kode_penjualan)->sum('total_harga_item')}}</span>,-</h4>	
		</div>
		<div class="col-sm">
			<a href="{{route('transaksi.pdf',$data_transaksi->kode_penjualan)}}"  class="btn btn-primary btn-block"><i class="fa fa-print mr-2"></i>Print Nota</a>
		</div>
	</div>

@else
<div class="row">
	<div class="col-sm">
		<form action="{{route('transaksi.cari',$data_transaksi->kode_penjualan)}}" method="POST" id="pencarianProduk">
			@csrf
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" name="cari" required="" maxlength="100" placeholder="Cari Berdasarkan Kode Produk " autocomplete="off">
					<span class="input-group-prepend">
						<button class="btn btn-sm btn-primary " type="submit">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</div>
		</form>
		@if(@$pencarian)
			Hasil pencarian Produk  : <b>{{$pencarian}}</b> 
			<hr>
			@if($data_produk =='PBC')
				@include('dashboard.transaksi.produk.produk_cleaner')
			@elseif($data_produk =='PBF')
				@include('dashboard.transaksi.produk.produk_frame')
			@elseif($data_produk =='PBS')
				@include('dashboard.transaksi.produk.produk_softlens')
			@elseif($data_produk =='PBV')
				@include('dashboard.transaksi.produk.produk_sv')
			@elseif($data_produk =='PBB')
				@include('dashboard.transaksi.produk.produk_bf')
			@endif
		@endif
		<div class="row">
			<div class="col-sm ">
				<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="border border p-2 tambahBarang">
					@csrf
					<div class="row">
						<div class="col-sm">
							<div class="form-group">
								<label for="">Jasa Pewarnaan</label>
								<select name="jasa_warna" id="" class="form-control">
									@foreach($jasa_warna as $warna)
									<option value="{{$warna->kode_warna}}#{{$warna->warna}}#{{$warna->harga_warna}}">{{$warna->warna}} - <span class="harga">Rp {{number_format($warna->harga_warna)}}</span></option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm">		
							<div class="form-group">
								<label for="">Keterangan</label>
								<input type="text" name="keterangan" class="form-control">
							</div>
						</div>
					</div>
					<button class="btn btn-sm btn-outline-success btn-block">Tambah Pewarnaan</button>
				</form>	
			</div>
			<div class="col-sm">
				<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="border border p-2 tambahBarang">
					@csrf
					<div class="row">
						<div class="col-sm">
							<div class="form-group">
								<label for="">Jasa Facet</label>
								<select name="jasa_facet" id="" class="form-control">
									@foreach($jasa_facet as $facet)
									<option value="{{$facet->kode_facet}}#{{$facet->nama_facet}}#{{$facet->harga}}">{{$facet->nama_facet}} - Rp {{number_format($facet->harga)}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="">Ketarangan</label>
								<input type="text" name="keterangan" class="form-control">	
							</div>
						</div>
					</div>
					<button class="btn btn-outline-primary btn-sm btn-block">Tambah Facet</button>
				</form>	
			</div>
		</div>

	</div>
	<div class="col-sm-2">
		<button class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#batalTransaksi">Batal Transaksi</button><br>
		<div class="btn-outline-primary btn btn-block p-2 rounded text-center ">
			<span>Status Transaksi</span>
			@if($data_transaksi->status_pembelian ==1)
				<span>
					<br><i class="fa fa-spinner fa-spin mr-2"></i>Proses
				</span>
			@else
				<i class="fa fa-check mr-2"></i>Berhasil
			@endif
		</div>
	</div>
</div>
<h5 class="p-2"><i class="fa fa-shopping-basket mr-2 text-success"></i>Daftar Belanjaan</h5>
<table class="table table-sm table-light table-hover table-striped">
	<tr>
		<th>Kode Barang</th>
		<th>Jenis</th>
		<th>Merk</th>
		<th>Harga</th>
		<th>Qty</th>
		<th>Total Harga</th>
		<th>Keterangan</th>
		<th></th>
	</tr>
	@foreach($data_transaksi->table_item_terjual as $item)	
		<tr>
			<td class="align-middle"><small>{{$item->kode_master_produk}}</small></td>
			<td class="align-middle">
				@if($item->jenis_produk == 'PBB')
				L.Bifokal
				@elseif($item->jenis_produk == 'PBV')
				L.Singgle Vision
				@elseif($item->jenis_produk == 'PBC')
				Pembersih
				@elseif($item->jenis_produk == 'PBF')
				Frame
				@elseif($item->jenis_produk == 'PBS')
				Softlens
				@else
				Jasa
				@endif
			</td>
			<td class="align-middle">{{$item->nama_barang}}</td>
			<td class="align-middle">
				Rp
				<span class="harga">{{$item->total_harga_item / $item->banyak_item}}</span>
			</td>
			<td class="align-middle">{{$item->banyak_item}}</td>
			<td class="align-middle">
				Rp
				<span class="harga">{{$item->total_harga_item}}</span>
			</td>
			<td>
				<?php $data_ket=explode('#', $item->keterangan) ?>
				@foreach($data_ket as $ket)
					<div class="p-1 rounded border border small m-1" style="display: inline-block;">{{$ket}}</div>
				@endforeach
			</td>
			<td class="align-middle">
				<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusItem{{$item->kode_barang_terjual}}">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		{{-- modal hapus item --}}
			@include('dashboard.transaksi.modal_hapus_item')

	@endforeach
</table>
<hr>
<div class="row">
	<div class="col-sm">
		<h4>Total Pembayaran :</h4>
		<h4>Rp <span class="harga">{{$data_transaksi->table_item_terjual->where('fg_kode_penjualan',$data_transaksi->kode_penjualan)->sum('total_harga_item')}}</span>,-</h4>	
	</div>
	<div class="col-sm">
		<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#lakukanPembayaran"><i class="fa fa-check mr-2"></i>Lakukan Pembayaran</button>
	</div>
</div>

{{-- modal batal transaksi--}}
<div class="modal fade" tabindex="-1" id="batalTransaksi">
	<div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content">
			<div class="modal-body">
				Apakah anda yakin ingin membatalkan transaksi ?
			</div>
				<form action="{{route('transaksi.batal',$data_transaksi->kode_penjualan)}}" method="POST" id="deleteTransaksi">
				@csrf
					{{method_field('DELETE')}}
				<div class="modal-footer">
						<button class="btn btn-outline-danger btn-block" type="submit">Batal Transaksi</button>
						<button class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
				</div>
				</form>
		</div>
	</div>
</div>


{{-- modal pembayaran --}}
@include('dashboard.transaksi.modal_pembayaran')
@endif

<script>
		$(document).ready(function(){
			$('.harga').mask("#.##0.000", {reverse: true})
			$('#pencarianProduk').on('submit',function(){
				$('#modalProsesPencarian').modal('show')
			})
			$('.tambahBarang').on('submit',function(){
				$('#modalProsesTambah').modal('show')	
			})
			$('#deleteTransaksi').on('submit',function(){
				$('#batalTransaksi').modal('hide')	
				$('#modalProsesHapus').modal('show')	
			})

			
		})
</script>

@endsection