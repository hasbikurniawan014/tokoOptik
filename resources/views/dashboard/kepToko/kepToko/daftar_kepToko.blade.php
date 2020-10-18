@extends('layouts.app')
@section('content')
<h5><i class="fa fa-users mr-2"></i>Daftar Pengguna :  Kepala Toko</h5>
<hr>
@include('dashboard.kepToko.kepToko.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('kepToko.index')}}" class="text-info" id="resetDatakepToko"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahkepToko"><i class="fa fa-plus mr-2"></i>Tambah Kepala Toko</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('kepToko.pencarian')}}" method="GET" id="carikepToko">
			{{-- @csrf --}}
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
{{$kepToko->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>No.kepToko</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Kelamin</th>
			<th>Tgl.Lahir</th>
			<th>Status</th>
			<th>Alamat</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($kepToko as $data_kepToko)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_kepToko->fg_kepala_toko}}</td>
			<td>{{$data_kepToko->table_user->nama}}</td>
			<td>
				@if($data_kepToko->table_user->email)
				{{$data_kepToko->table_user->email}}
				@else
				Tidak Ada email
				@endif
			</td>
			<td class="text-center">{{$data_kepToko->kelamin}}</td>
			<td>{{$data_kepToko->tgl_lahir}}</td>
			<td class="text-center">
				@if($data_kepToko->status_kepala_toko ==1)
				Aktif
				@else
				Tidak aktif
				@endif
			</td>
			<td>{{$data_kepToko->alamat}}</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#ubahkepToko{{$data_kepToko->fg_kepala_toko}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#hapuskepToko{{$data_kepToko->fg_kepala_toko}}" 
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
			$('#storekepToko').on('submit',function(){
				$('#tambahkepToko').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#carikepToko').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			$('#resetDatakepToko').click(function(){
				$('#modalProsesReset').modal('show');
			})
		})
</script>
@endsection