@extends('layouts.app')
@section('content')
<h5><i class="fa fa-th-list mr-2"></i>Daftar Type & Kategori</h5>
<hr>
@include('dashboard.kepToko.type.modal_type')
@include('dashboard.kepToko.type.modal_kategori')
<div class="row">
	<div class="col-sm">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahType"><i class="fa fa-plus mr-2"></i>Tambah type</button><hr>		
		{{$type->links()}}
		<div class="table-responsive">
			<table class="table table-sm table-striped table-bordered table-hover">
				<tr>
					<th class="text-center">No</th>
					<th>Kode Type</th>
					<th>Type</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($type as $data_type)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td>{{$data_type->kode_type_lensa}}</td>
					<td>{{$data_type->type_lensa}}</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#ubahtype{{$data_type->kode_type_lensa}}" 
								class="btn btn-outline-primary btn-sm">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#hapustype{{$data_type->kode_type_lensa}}" 
								class="btn btn-outline-danger btn-sm">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>		
	</div>
	<div class="col-sm">
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategori"><i class="fa fa-plus mr-2"></i>Tambah Kategori</button><hr>		
		{{$kategori->links()}}
		<div class="table-responsive">
			<table class="table table-sm table-striped table-bordered table-hover">
				<tr>
					<th class="text-center">No</th>
					<th>Kode Kategori</th>
					<th>kategori</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($kategori as $data_kategori)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td>{{$data_kategori->kode_kategori_lensa}}</td>
					<td>{{$data_kategori->kategori}}</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#ubahKategori{{$data_kategori->kode_kategori_lensa}}" 
								class="btn btn-outline-primary btn-sm">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#hapusKategori{{$data_kategori->kode_kategori_lensa}}" 
								class="btn btn-outline-danger btn-sm">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>		
	</div>
</div>

<script>

	$(document).ready(function(){
			$('.tanggal').mask('00/00/0000');
			$('.stok').mask('00');
			$('.harga').mask("#.##0.000.000", {reverse: true})
			$('#storeType').on('submit',function(){
				$('#tambahType').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#storeKategori').on('submit',function(){
				$('#tambahKategori').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
		})
</script>
@endsection