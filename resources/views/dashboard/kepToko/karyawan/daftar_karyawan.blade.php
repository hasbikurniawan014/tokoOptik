@extends('layouts.app')
@section('content')
<h5><i class="fa fa-users mr-2"></i>Daftar Pengguna :  Karyawan</h5>
<hr>
@include('dashboard.kepToko.karyawan.modal')
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('karyawan.index')}}" class="text-info" id="resetDataKaryawan"> Reset Pencarian</a>
	@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKaryawan"><i class="fa fa-plus mr-2"></i>Tambah Karyawan</button>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('karyawan.pencarian')}}" method="GET" id="cariKaryawan">
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
{{$karyawan->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>No.Karyawan</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Kelamin</th>
			<th>Tgl.Lahir</th>
			<th>Status</th>
			<th>Alamat</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($karyawan as $data_karyawan)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_karyawan->fg_karyawan}}</td>
			<td>{{$data_karyawan->table_user->nama}}</td>
			<td>
				@if($data_karyawan->table_user->email)
				{{$data_karyawan->table_user->email}}
				@else
				Tidak Ada email
				@endif
			</td>
			<td class="text-center">{{$data_karyawan->kelamin}}</td>
			<td>{{$data_karyawan->tgl_lahir}}</td>
			<td class="text-center">
				@if($data_karyawan->status_karyawan ==1)
				Aktif
				@else
				Tidak aktif
				@endif
			</td>
			<td>{{$data_karyawan->alamat}}</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#ubahKaryawan{{$data_karyawan->fg_karyawan}}" 
						class="btn btn-outline-primary btn-sm">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<td class="text-center">
				<button data-toggle="modal" data-target="#hapusKaryawan{{$data_karyawan->fg_karyawan}}" 
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
			$('#storeKaryawan').on('submit',function(){
				$('#tambahKaryawan').modal('hide');
				$('#modalProsesTambah').modal('show');
			})
			$('#cariKaryawan').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			$('#resetDataKaryawan').click(function(){
				$('#modalProsesReset').modal('show');
			})
		})
</script>
@endsection