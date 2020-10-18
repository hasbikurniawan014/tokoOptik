@extends('layouts.app')
@section('content')
<h5><i class="fa fa-cubes mr-2"></i>Daftar Softlens</h5>
<hr>
@include('dashboard.kepToko.softlens.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('softlens.index')}}" class="text-info" id="resetDataSoftlens"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSoftlens"><i class="fa fa-plus mr-2"></i>Tambah Softlens</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('softlens.pencarian')}}" method="GET" id="cariSoftlens">
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
{{$softlens->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>kode produk</th>
			<th>merk</th>
			<th>warna</th>
			<th>ukuran</th>
			<th>harga jual</th>
			<th>Stok</th>
			<th width="1">periode</th>

			<th></th>
			<th></th>
		</tr>
		@foreach($softlens as $data_Softlens)

		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_Softlens->kode_produk}}</td>
			<td>{{$data_Softlens->merk}}</td>
			<td>{{$data_Softlens->warna}}</td>
			<td>{{ucfirst($data_Softlens->ukuran)}}</td>

			<td>
				Rp <span class="harga">{{$data_Softlens->harga_jual}}</span>,-
			</td>
			<td>
				{{$data_Softlens->stok}}
			</td>
			<td>
				{{$data_Softlens->periode}} Bulan
			</td> 
			<td class="text-center">
				<button data-toggle="modal" data-target="#ubahSoftlens{{$data_Softlens->kode_produk}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#hapusSoftlens{{$data_Softlens->kode_produk}}" 
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
			$('.periode').mask('00');
			$('.harga').mask("#.##0.000", {reverse: true})
			$('#storeSoftlens').on('submit',function(){
				$('#tambahSoftlens').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#cariSoftlens').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			$('#resetDataSoftlens').click(function(){
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