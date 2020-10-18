@extends('layouts.app')
@section('content')
<h5><i class="fa fa-cubes mr-2"></i>Daftar Frame</h5>
<hr>
@include('dashboard.kepToko.frame.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('frame.index')}}" class="text-info" id="resetDataframe"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahFrame"><i class="fa fa-plus mr-2"></i>Tambah frame</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('frame.pencarian')}}" method="GET" id="cariframe">
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
{{$frame->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>kode produk</th>
			<th>merk</th>
			<th>harga jual</th>
			<th>Stok</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($frame as $data_frame)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_frame->kode_produk}}</td>
			<td>{{$data_frame->merk}}</td>
			<td>
				Rp <span class="harga">{{$data_frame->harga_jual}}</span>,-
			</td>
			<td>
				{{$data_frame->stok}}
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#ubahframe{{$data_frame->kode_produk}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#hapusframe{{$data_frame->kode_produk}}" 
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
		$('.harga').mask("#.##0.000", {reverse: true})
		$('#storeFrame').on('submit',function(){
			$('#tambahFrame').modal('hide');
			$('#modalProsesTambah').modal('show');
		})
		$('#cariframe').on('submit',function(){
			$('#modalProsesPencarian').modal('show');
		})
		$('#resetDataframe').click(function(){
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