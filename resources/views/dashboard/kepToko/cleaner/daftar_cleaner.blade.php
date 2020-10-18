@extends('layouts.app')
@section('content')
<h5><i class="fa fa-cubes mr-2"></i>Daftar Cleaner</h5>
<hr>
@include('dashboard.kepToko.cleaner.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('cleaner.index')}}" class="text-info" id="resetDataCleaner"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahCleaner"><i class="fa fa-plus mr-2"></i>Tambah Cleaner</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('cleaner.pencarian')}}" method="GET" id="cariCleaner">
			<div class="input-group">
				<input type="text" name="pencarian" class="form-control" autocomplete="off" required="">
				<span class="input-group-prepend">
					<button class="btn btn-primary btn-sm" type="submit">Cari</button>
				</span>
			</div>
		</form>
	</div>
</div>
<hr>
{{$cleaner->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>kode produk</th>
			<th>merk</th>
			<th>jenis</th>
			<th>harga jual</th>
			<th>Stok</th>
			<th>volume</th>
			<th>periode</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($cleaner as $data_cleaner)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_cleaner->kode_produk}}</td>
			<td>{{$data_cleaner->merk}}</td>
			<td>{{$data_cleaner->jenis}}</td>
			<td>
				Rp <span class="harga">{{$data_cleaner->harga_jual}}</span>,-
			</td>
			<td>
				{{$data_cleaner->stok}}
			</td>
			<td>
				{{$data_cleaner->volume}} ml
			</td>
			<td>
				{{$data_cleaner->periode}} Bulan
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#ubahCleaner{{$data_cleaner->kode_produk}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#hapusCleaner{{$data_cleaner->kode_produk}}" 
						class="btn btn-outline-danger btn-sm">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		@endforeach
	</table>
</div>
<script>
	$(document).ready(function(){
			$('.tanggal').mask('00/00/0000');
			$('.stok').mask('00');
			$('.volume').mask('000');
			$('.periode').mask('00');
			$('.harga').mask("#.##0.000", {reverse: true})
			$('#storeCleaner').on('submit',function(){
				$('#tambahCleaner').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#cariCleaner').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			$('#resetDataCleaner').click(function(){
				$('#modalProsesReset').modal('show');
			})
			$('.stok_barang').blur(function(){
				var stok=parseInt($(this).val());
				var item=stok*12;
				$('.item').val(item);

			})
		})
</script>
@endsection