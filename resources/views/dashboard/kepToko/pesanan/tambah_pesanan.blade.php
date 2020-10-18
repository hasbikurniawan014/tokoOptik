@extends('layouts.app')
@section('content')
@if($data_pesanan->status_pesanan==2)
	@include('dashboard.kepToko.pesanan.dp_diterima')
@elseif($data_pesanan->status_pesanan==3)
	@include('dashboard.kepToko.pesanan.lunas')
@else
	<h5><i class="fa fa-shopping-bag mr-2 text-success"></i>Tambah Item Pesanan</h5>
	<hr>
	<div class="row">
		<div class="col-sm">
			<a href="{{route('home')}}" class="p-2"><i class="fa fa-arrow-left mr-2"></i> Kembali</a>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#batal"><i class="fa fa-times mr-2"></i>Batalkan pesanan</button>
		</div>
	</div>
	<div class="input-group">
		<div class="input-group-prepend bg-primary p-2 text-light">
			<i class="fa fa-shopping-bag mr-2"></i> Jenis Pesanan 
		</div>
		<select name="pesanan" id="pesananJenis" class="form-control">
			<option value="df" selected>Default</option>
			<option value="bf">Bifokal</option>
			<option value="sv">Singgle Vision</option>
		</select>	
	</div>
	
	<form action="{{route('pesanan.tambahItem',$data_pesanan)}}" method="POST" id="tambahItem">
		@csrf
		 <br>
		<div id="pesananForm">
				<div class="row">
					<input type="text" name="jenis" value="df" hidden="">
					<div class="col-sm-2">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" required="" class="form-control" maxlength="15" autocomplete="off">
					</div>
					<div class="col-sm">
						<label for="">Pesanan</label>
						<input type="text" name="pesanan" required="" class="form-control" maxlength="55" autocomplete="off">
					</div>
					<div class="col-sm-1">
						<label for="">Jumlah</label>
						<input type="text" name="jumlah" required="" autocomplete="off" class="form-control jumlah" value="">
					</div>
					<div class="col-sm-2">
						<label for="">Harga</label>
						<input type="text" name="harga" required="" class="form-control harga" maxlength="55">
					</div>
					<div class="col-sm">
						<label for="">Keterangan</label>
						<div class="input-group">
							<input type="text" name="keterangan"  class="form-control"  placeholder="Boleh kosong" autocomplete="off">
						</div>
					</div>
				</div>
		</div>
		<br>
			<button class="btn btn-success btn-block "><i class="fa fa-plus mr-2"></i>Tambah Pesanan</button>
	</form>	
	
	<hr>
	{{--  --}}
	<h5>Daftar Item pesanan</h5>
	<table class="table table-sm table-hover table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Produk</th>
				<th>Pesanan</th>
				<th>Qty</th>
				<th>Harga</th>
				<th>Total Harga</th>
				<th>Keterangan</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($data_pesanan->table_item_pesanan as $item)
			<tr class="align-middle">
				<td  class="align-middle">{{$loop->iteration}}</td>
				<td  class="align-middle">{{$item->kode_produk}}</td>
				<td  class="align-middle">{{$item->pesanan}}</td>
				<td  class="align-middle">{{$item->jumlah}}</td>
				<td  class="align-middle">Rp <span  class="harga">{{$item->harga/$item->jumlah}}</span></td>
				<td  class="align-middle">Rp <span  class="harga">{{$item->harga}}</span></td>
				<td  class="align-middle" width="400">
					@if($item->keterangan)
					<?php $data=explode('#',$item->keterangan)?>
					@foreach($data as $dataket)
						<div class="p-1 border border m-1" style="display: inline-block;">{{$dataket}}</div>
					@endforeach
					@else
					<i>Tidak ada keterangan </i>
					@endif
				</td>
				<td  class="align-middle">
					<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editItem{{$item->kode_produk}}"><i class="fa fa-pencil"></i></button>
				</td>
				<td  class="align-middle">
					<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusItem{{$item->kode_produk}}"><i class="fa fa-trash"></i></button>
				</td>
			</tr>

			@endforeach
		</tbody>
	</table>

	<h4>
		<div class="row">
			<div class="col-sm">
			<div class="mb-3"> <i class="fa fa-money text-success mr-2"></i> 
				Total Harga 
			</div>
				Rp <span>
					{{number_format( $data_pesanan->table_item_pesanan->sum('harga'))}}
				</span> ,-
			</div>
			<div class="col-sm">
				<div class="mb-3">Uang Muka wajib 50%</div>
				Rp <span>
					{{number_format( $data_pesanan->table_item_pesanan->sum('harga')/2)}}
				</span>
			</div>
			<div class="col-sm">
				<div class="m-3">
				<form action="{{route('pesanan.update',$data_pesanan->kode_pesanan)}}" method="POST" id="terimaDp">
					@csrf
					{{method_field('PUT')}}
					<button class="btn btn-success btn-block" type="submit"><i class="fa fa-money mr-2"></i>Terima uang muka</button>
				</form>
				</div>
			</div>
		</div>
	</h4>
@include('dashboard.kepToko.pesanan.modal_pesanan')
@endif
<script>
$(document).ready(function(){
	$('.harga').mask("#.##0.000", {reverse: true})
	$('.jumlah').mask("00");
	$('#tambahItem').on('submit',function(){
		$('#modalProsesTambah').modal('show');
	})
	$('#terimaDp').on('submit',function(){
		$('#modalProsesTambah').modal('show');
	})

	$('#pesananJenis').change(function(){
		$('.harga').mask("#.##0.000", {reverse: true})
		$('.jumlah').mask("00");
		var data=$(this).find(':selected').attr('value');
		console.log(data);
		 if(data=='df'){
		 	$('.harga').mask("#.##0.000", {reverse: true})
			$('.jumlah').mask("00");
		 	var df='';
			df +='<input type="text" name="jenis" value="df" hidden="">';
 			 df +='<div class="form-group">';
 			 df +='<div class="row">';
 			 df +='<div class="col-sm-2">';
 			 df +='<label for="">Kode Produk</label>';
 			 df +='<input type="text" name="kode_produk" required="" class="form-control" maxlength="15" autocomplete="off">';
 			 df +='</div>';
 			 df +='<div class="col-sm">';
 			 df +='<label for="">Pesanan</label>';
 			 df +='<input type="text" name="pesanan" required="" class="form-control" maxlength="55" autocomplete="off">';
 			 df +='</div>';
 			 df +='<div class="col-sm-1">';
 			 df +='<label for="">Jumlah</label>';
 			 df +='<input type="text" name="jumlah" required="" autocomplete="off" class="form-control jumlah" value="">';
 			 df +='</div>';
 			 df +='<div class="col-sm-2">';
 			 df +='<label for="">Harga</label>';
 			 df +='<input type="text" name="harga" required="" class="form-control harga" maxlength="55">';
 			 df +='</div>';
 			 df +='<div class="col-sm">';
 			 df +='<label for="">Keterangan</label>';
 			 df +='<div class="input-group">';
 			 df +='<input type="text" name="keterangan"  class="form-control"  placeholder="Boleh kosong" autocomplete="off">';
 			 df +='<span class="input-group-prepend">';
 			 df +='<button class="btn btn-success btn-sm "><i class="fa fa-plus mr-2"></i>Tambah Pesanan</button>';
 			 df +='</span>';
 			 df +='</div>';
 			 df +='</div>';
 			 df +='</div>';
 			 df +='</div>';
			 $('#pesananForm').html(df);
		 }else if(data=='bf'){
		 var bf='';
			bf +='<input type="text" name="jenis" value="bf" hidden="">';
			bf +='<div class="form-group">';
			bf +='<div class="form-group">';
			bf +='<label for="">Jumlah Pemesanan</label>';
			bf +='<input type="text" name="jumlah" class="form-control" required autocomplete="off" maxlength="2">';
			bf +='<br>';
			bf +='<label for="">Kode Produk</label>';
			bf +='<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16">';
			bf +='</div>';
			bf +='<div class="form-group">';
			bf +='<label for="">merk </label>';
			bf +='<input type="text" name="pesanan" class="form-control" maxlength="25"  required="">';
			bf +='</div>';
			bf +='<div class="row">';
			bf +='<div class="col-sm">';
			bf +='<label for="">Kategori Lensa</label>';
			bf +='<select name="kategori" id="" class="form-control">';
			bf +='@foreach($kategori as $data_kategori)';
			bf +='<option value="{{$data_kategori->kategori}}">{{$data_kategori->kategori}}</option>';
			bf +='@endforeach';
			bf +='</select>';
			bf +='</div>';
			bf +='<div class="col-sm">';
			bf +='<label for="">Type Lensa</label>';
			bf +='<select name="type" id="" class="form-control">';
			bf +='@foreach($type as $data_type)';
			bf +='<option value="{{$data_type->type_lensa}}">{{$data_type->type_lensa}}</option>';
			bf +='@endforeach';
			bf +='</select>';
			bf +='</div>';
			bf +='</div>';
			bf +='<div class="form-group mt-3 container">';
			bf +='<div class="row">';
			bf +='<div class="col-sm  border border p-2 m-1">';
			bf +='<p class="text-center">Lensa</p>';
			bf +='<div class="row text-center">';
			bf +='<div class="col-sm">';
			bf +='<small>Kanan</small>';
			bf +='<input type="text" class="form-control" name="lensa_kanan" required="" maxlength="6">		';
			bf +='</div>';
			bf +='<div class="col-sm">';
			bf +='<small>Kiri</small>';
			bf +='<input type="text" class="form-control" name="lensa_kiri" required="" maxlength="6">		';
			bf +='</div>';
			bf +='</div>';
			bf +='</div>';
			bf +='<div class="col-sm  border border p-2 m-1">';
			bf +='<p class="text-center">Silinder</p>';
			bf +='<div class="row text-center">';
			bf +='<div class="col-sm">';
			bf +='<small>Kanan</small>';
			bf +='<input type="text" class="form-control" name="silinder_kanan" required="" maxlength="6">			';
			bf +='</div>';
			bf +='<div class="col-sm">';
			bf +='<small>Kiri</small>';
			bf +='<input type="text" class="form-control" name="silinder_kiri" required="" maxlength="6">			';
			bf +='</div>';
			bf +='<div class="col-sm">';
			bf +='<small>Axis</small>';
			bf +='<input type="text" class="form-control" name="axis"  maxlength="6">			';
			bf +='</div>';
			bf +='</div>';
			bf +='</div>';
			bf +='</div>';
			bf +='</div>';
			bf +='<div class="form-group">';
			bf +='<label for="">Add</label>';
			bf +='<input type="text" name="add" class="form-control"  maxlength="6">';
			bf +='</div>';
			bf +='<div class="form-group">';
			bf +='<label for="">Harga </label>';
			bf +='<div class="input-group">';
			bf +='<span class="input-group-prepend">';
			bf +='<span class="btn btn-sm btn-white">Rp</span>';
			bf +='</span>';
			bf +='<input type="text" name="harga"  class="form-control harga	" required="">';
			bf +='</div>';
			bf +='</div>';
			bf +='</div>';
	 		$('#pesananForm').html(bf);
		 }
		 else if (data == 'sv') 
		 {
		 	$('.harga').mask("#.##0.000", {reverse: true})
			$('.jumlah').mask("00");
			var sv='';
			sv+='<input type="text" name="jenis" value="sv" hidden="">'
			sv+='<div class="form-group">'
			sv+='<label for="">Jumlah </label>'
			sv+='<input type="text" name="jumlah" class="form-control" required autocomplete="off" maxlength="2">'
			sv+='</div>'
			sv+='<div class="form-group">'
			sv+='<label for="">Kode Produk</label>'
			sv+='<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16">'
			sv+='</div>'
			sv+='<div class="form-group">'
			sv+='<label for="">merk </label>'
			sv+='<input type="text" name="pesanan" class="form-control" maxlength="25"  required="">'
			sv+='</div>'
			sv+='<div class="form-group">'
			sv+='<div class="row">'
			sv+='<div class="col-sm-5  border border p-2 m-2">'
			sv+='<p for="" class="text-center">Ukuran lensa</p>'
			sv+='<div class="row text-center">'
			sv+='<div class="col-sm">'
			sv+='<small>Kiri</small>'
			sv+='<input type="text" class="form-control" name="lensa_kiri" required="" maxlength="6">	'
			sv+='</div>'
			sv+='<div class="col-sm">'
			sv+='<small>kanan</small>'
			sv+='<input type="text" class="form-control" name="lensa_kanan" required="" maxlength="6">	'
			sv+='</div>'
			sv+='</div>'
			sv+='</div>'
			sv+='<div class="col-sm  border border p-2 m-2">'
			sv+='<p class="text-center">Silinder</p>'
			sv+='<div class="row text-center">'
			sv+='<div class="col-sm">'
			sv+='<small>Kiri</small>'
			sv+='<input type="text" class="form-control" name="silinder_kiri" required="" maxlength="6">	'
			sv+='</div>'
			sv+='<div class="col-sm">'
			sv+='<small>Kanan</small>'
			sv+='<input type="text" class="form-control" name="silinder_kanan" required="" maxlength="6">'
			sv+='</div>'
			sv+='<div class="col-sm">'
			sv+='<small>Axis</small>'
			sv+='<input type="text" class="form-control" name="axis" required="" maxlength="3">'
			sv+='</div>'
			sv+='</div>'
			sv+='</div>'
			sv+='</div>'
			sv+='</div>'
			sv+='<div class="form-group">'
			sv+='<label for="">Type Lensa</label>'
			sv+='<select name="type" id="" class="form-control">'
			sv+='@foreach($type as $data_type)'
			sv+='<option value="{{$data_type->kode_type_lensa}}">{{$data_type->type_lensa}}</option>'
			sv+='@endforeach'
			sv+='</select>'
			sv+='</div>'
			sv+='<div class="form-group">'
			sv+='<label for="">Harga </label>'
			sv+='<div class="input-group">'
			sv+='<span class="input-group-prepend">'
			sv+='<span class="btn btn-sm btn-white">Rp</span>'
			sv+='</span>'
			sv+='<input type="text" name="harga"  class="form-control harga	" required="">'
			sv+='</div>'
			sv+='</div>'
			$('#pesananForm').html(sv);
		 }

	})
})
</script>
@endsection