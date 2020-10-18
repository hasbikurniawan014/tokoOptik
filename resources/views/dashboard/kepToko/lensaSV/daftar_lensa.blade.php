@extends('layouts.app')
@section('content')
<h5><i class="fa fa-eye mr-2"></i>Daftar Lensa :  Single Vision </h5>
<hr>
@include('dashboard.kepToko.lensaSV.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('lensaSv.index')}}" class="text-info" id="resetDataLensa"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLensa"><i class="fa fa-plus mr-2"></i>Tambah Lensa</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('lensaSv.pencarian')}}" method="GET" id="cariLensa">
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
{{$lensa->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr class="bg-light text-center">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th colspan="2">Lensa</th>
			<th colspan="2">Silinder</th>
			<th></th>
			<th></th>
		</tr>
		<tr class="text-center">
			<th class="text-center">No</th>
			<th>kode produk</th>
			<th>merk</th>
			<th>type</th>
			<th>Kiri</th>
			<th>Kanan</th>
			<th>Kiri</th>
			<th>Kanan</th>
			<th>harga jual</th>
			<th>Stok</th>

			<th></th>
			<th></th>
		</tr>
		@foreach($lensa as $data_Lensa)
		<tr class="text-center">
			<td>{{$loop->iteration}}</td>
			<td>{{$data_Lensa->fg_kode_produk_sv}}</td>
			<td>{{$data_Lensa->table_lensa_sv->merk}}</td>
			<td>{{$data_Lensa->table_type_lensa->type_lensa}}</td>
			<td>{{$data_Lensa->table_lensa_sv->lensa_kiri}}</td>
			<td>{{$data_Lensa->table_lensa_sv->lensa_kanan}}</td>
			<td>{{$data_Lensa->table_lensa_sv->silinder_kiri}}</td>
			<td>{{$data_Lensa->table_lensa_sv->silinder_kanan}}</td>
			<td>
				Rp <span class="harga">{{$data_Lensa->harga_jual}}</span>,-
			</td>
			<td>
				{{$data_Lensa->stok}}
			</td>
			<td>
				<button data-toggle="modal" data-target="#ubahLensa{{$data_Lensa->fg_kode_produk_sv}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td>
				<button data-toggle="modal" data-target="#hapusLensa{{$data_Lensa->fg_kode_produk_sv}}" 
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
			$('#storeLensa').on('submit',function(){
				$('#tambahLensa').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#cariLensa').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			$('#resetDataLensa').click(function(){
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