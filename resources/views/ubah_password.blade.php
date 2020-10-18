@extends('layouts.app')
@section('content')
	<h5><i class="fa fa-key mr-2"></i>Ubah Password</h5>
	<hr>
	<div class="container">
	<form action="{{route('home.update_pass',auth()->user()->username)}}" method="POST" id="update_pass">
		@csrf
		{{method_field('PATCH')}}
			<div class="form-group">
			<label for="">Masukan Password Yang lama</label>
				<div class="input-group">
					<span class="input-group-prepend">
						<i class="fa fa-clock-o p-2 bg-primary text-light  rounded"></i>
					</span>
					<input type="text" name="pass_lama" class="form-control form-control-sm" autocomplete="off" required="" minlength="6" value="{{old('pass_lama')}}">
				</div>
			</div>
			<div class="form-group">
			<label for="">Masukan Password Baru</label>
				<div class="input-group">
					<span class="input-group-prepend">
						<i class="fa fa-key p-2 bg-primary text-light  rounded"></i>
					</span>
					<input type="password" name="pass_baru" id="pass_baru" class="form-control form-control-sm" autocomplete="off" required="" minlength="6">
				</div>
			</div>
			<div class="form-group">
			<label for="">Masukan Password Baru</label>
				<div class="input-group">
					<span class="input-group-prepend">
						<i class="fa fa-key p-2 bg-primary text-light  rounded"></i>
					</span>
					<input type="password" name="kon_pass_baru" id="kon_pass_baru" class="form-control form-control-sm" autocomplete="off" required="" minlength="6">
				</div>
					<span id="errkonpas" class="text-danger"></span>
			</div>
			<button type="submit" class="btn btn-outline-primary"><i class="fa fa-paper-plane mr-3"></i>Simpan Perubahan</button>
	</form>
	</div>
	<script>
		$(document).ready(function(){
			$('#update_pass').on('submit',function(){
				if ($('#pass_baru').val() !== $('#kon_pass_baru').val()) 
				{
					$('#errkonpas').text('Konfirmasi Password tidak sama ')
					return false;
				}else{

					$('#errkonpas').text('')
					$('#modalProsesUbah').modal('show');
				}
			})
		})
	</script>
@endsection