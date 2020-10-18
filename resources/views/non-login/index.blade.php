@extends('layouts.login_page')
@section('nonLogin')
<div class="bg"></div>
	<div class=" p-2 text-light animated fadeIn" style="background: 
	#3490dc99">
		<p class="text-capitalize text-center sticky-top p-2">sistem monitoring inventori barang </p>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm">
					{{-- <img src="{{url('gambar/svg/svg1.svg')}}" alt="" class="w-75 animated fadeInDown delay-1s" style="margin: 10px auto"> --}}
					<div class="text-left animated fadeInDown delay-1s" style="margin: 150px auto">
						<h1 class=" ff-1">Toko Frame dan Aksesoris Kacatama <br> Miranti Optik</h1>
						 <hr>
						<small style="">Wetan, Kota Bandung 40135, Telepon: (022) 4222892</small>
					</div>
				</div>
				<div class="col-sm">
					<form action="{{route('login')}}" method="POST" id="login_form" class="text-left animated fadeInUp delay-1s" style="margin: 40px auto">
						@csrf
						<p id="resLogin" class="alert animated rubberBand">
							<i id="resIcon"></i>
							<span class="textRes"></span>
						</p>
						<p><i class="fa fa-key mr-2"></i>Login Aplikasi</p>
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control-plaintext b-bottom text-light" name="username" id="username" placeholder="Masukan username" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" id="password" class="form-control-plaintext text-light b-bottom" placeholder="**********" autocomplete="off">
						</div>
						<button class="btn btn-outline-light btn-block ">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<svg class="animated fadeIn zz" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3490dc99" fill-opacity="1" d="M0,128L48,112C96,96,192,64,288,90.7C384,117,480,203,576,245.3C672,288,768,288,864,256C960,224,1056,160,1152,117.3C1248,75,1344,53,1392,42.7L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>


@endsection