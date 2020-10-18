<div>
	<div class="row">
		<div class="col-sm">
		<h1><i class="fa fa-home mr-2 text-primary"></i> Halaman Utama</h1>
		</div>
		<div class="col-sm">
			Hari ini : <br><b>{{date('d M Y')}}</b>
		</div>
	</div>
</div> 	<hr>
<div class="row">
	{{-- kolom_1 --}}
	<div class="col-sm-5">
		<div class="border border p-3">
				<button type="button" data-toggle="modal" data-target="#transaksiModal" class="btn btn-block btn-outline-primary rounded p-3 ">
						<i class="fa fa-calculator  p-2"></i>
						Transaksi Barang
				</button>
			<hr>
			<h5><i class="fa fa-clock-o mr-2 text-primary"></i>Sejarah Transaksi</h5><hr>
			@foreach($transaksi as $tr)
				<div class="bg-white p-3 rounded border border">
					<div class="border border p-2">
						<div class="row">
							<div class="col-sm m-1">
								<i class="fa fa-clock-o text-primary mr-2"></i> 
								{{$tr->created_at->format('d F y')}}	
							</div>
							<div class="col-sm">
								<a href="{{route('transaksi.index',$tr->kode_penjualan)}}" class="btn btn-outline-primary btn-sm btn-block">Detail</a>
							</div>
						</div>
					</div>
					<div class="">
						<table class="table  ">
							<tr>
								<th>No.Penjualan </th>
								<td>{{$tr->kode_penjualan}}</td>
							</tr>
							<tr>
								<th>Status Pembelian </th>
								<td>
									@if($tr->status_pembelian == 2)
										<i class="fa fa-check text-primary mr-2"></i>
										Sukses
									@else
										<i class="fa fa-spinner fa-spin  text-primary mr-2"></i>
										Proses
									@endif
								</td>
							</tr>
						</table>
					</div>
				</div>
			@endforeach
			@if(count($transaksi)>0)
			<a href="{{route('transaksi.sejarah')}}" class="btn btn-outline-primary btn-block mt-2">Tampilkan lebih banyak</a>
			@endif
		</div>
	</div>
	{{-- kolom_2 --}}
	<div class="col-sm">
		<div class="row">
			<div class="col-sm">
				<div class="bg-light border borderp p-3">
					<button data-toggle="modal" data-target="#pesananModal" class="btn btn-outline-success p-3 btn-block"  type="button">
						<i class="fa fa-pencil-square-o mr-2"></i> Tambah pesanan 
					</button>
					<hr>
					<h5><i class="fa fa-spinner mr-2 text-success"></i>Daftar Pesanan</h5>
					<hr>
					@forelse($pesanan as $pesan)	
						<table class="table table-sm table-bordered">
							<tr>
								<th>No.Pesanan</th>
								<td>{{$pesan->kode_pesanan}}</td>
							</tr>
							<tr>
								<th>tgl.pesan</th>
								<td>{{date('d F y',strtotime($pesan->tgl_pesan))}}</td>
							</tr>
							<tr>
								<th>tgl.selesai</th>
								<td>{{date('d F y',strtotime($pesan->tgl_selesai))}}</td>
							</tr>
							<tr>
								<th>Status</th>
								<td class="text-primary">
								@if($pesan->status_pesanan == 1)
									<i class="fa fa-repeat mr-2"></i>Proses
								@elseif($pesan->status_pesanan == 2)
									<i class="fa fa-money mr-2"></i>DP diterima
								@elseif($pesan->status_pesanan == 3)
									<i class="fa fa-check mr-2"></i>Selesai
								@endif
								</td>
								<tr>
									<th></th>
									<td>
									<a href="{{route('pesanan.item',$pesan->kode_pesanan)}}" class="btn btn-success btn-sm btn-block">
										Detail
									</a>
									</td>
								</tr>
							</tr>
						</table>
					@empty
						Tidak ada pesanan
					@endif
				@if(count($pesanan)>0)
				<a href="{{route('pesanan.sejarah_pesanan')}}" class="btn btn-outline-success btn-block mt-2">Tampilkan lebih banyak</a>
				@endif
				</div>
			</div>
			{{-- kolom_3 --}}
			<div class="col-sm">
				{{-- Alert stok kurang dari 1 lusin --}}
					@if( count($frame->where('stok','<',10)) > 0  || count($typeSv->where('stok','<',10)) > 0 || count($typeBf->where('stok','<',10))>0 || count($cleaner->where('stok','<',10))>0 || count($soft->where('stok','<',10))>0 )
						@include('dashboard.kepToko.alert_stok_barang')
					@endif
				<div class="bg-light border borderp p-3">
					<h5><i class="fa fa-users mr-2 text-primary"></i>Jumlah Users</h5>
					<hr>
					<table class="table table-sm table-bordered">
						<tr>
							<th><i class="fa fa-users text-secondary mr-2"></i>Karyawan</th>
							<td>{{$karyawan->count()}} Karyawan</td>
						</tr>
					</table>
					<h5><i class="fa fa-cubes mr-2 text-primary"></i>Jumlah Produk Barang</h5>
					<hr>
					<div class="border border p-3" >
						<p class="border-bottom">Aksesoris Kacamata</p>
						<table class="table table-sm  table-bordered">
							<tr>
								<th><i class="fa fa-cube text-secondary mr-2"></i>Frame </th>
								<td>{{$frame->count()}} Item</td>
							</tr>
							<tr>
								<th><i class="fa fa-cube text-secondary mr-2"></i>Lensa Bifokal </th>
								<td>{{$typeSv->count()}} Item</td>
							</tr>
							<tr>
								<th><i class="fa fa-cube text-secondary mr-2"></i>Lensa Singgle Vision </th>
								<td>{{$typeBf->count()}} Item</td>
							</tr>
						</table>
						<p class="border-bottom">Lainya</p>
						<table class="table table-sm  table-bordered">
							<tr>
								<th><i class="fa fa-cube text-secondary mr-2"></i>Softlens </th>
								<td>{{$cleaner->count()}} Item</td>
							</tr>
							<tr>
								<th><i class="fa fa-cube text-secondary mr-2"></i>Pembersih </th>
								<td>{{$soft->count()}} Item</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


{{-- modal --}}
<form action="{{route('transaksi.tambahTransaksi')}}" method="POST" id="taransaksi">@csrf
	<div class="modal fade" tabindex="1" id="transaksiModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
					 	Nama Pembeli
					</h5>
				</div>
				<div class="modal-body">
					<input type="text" name="nama_pembeli" class="form-control" required=""  maxlength="25" autocomplete="off">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block">Tambah Transaksi</button>
					<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


{{-- modal pesanan --}}
<form action="{{route('pesanan.tambah')}}" method="POST" id="tambahPesanan">
	@csrf
	<form action="{{route('transaksi.tambahTransaksi')}}" method="POST" id="taransaksi">@csrf
	<div class="modal fade" tabindex="1" id="pesananModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
					 	Nama Pemesan
					</h5>
				</div>
				<div class="modal-body">
					<input type="text" name="nama_pembeli" class="form-control" required=""  maxlength="25" autocomplete="off">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block">Tambah Transaksi</button>
					<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
</form>
<script>
	$(document).ready(function(){
		$('#taransaksi').on('submit',function(){
			$('#transaksiModal').hide();
			$('#modalProsesTambah').modal('show');
		})	
		$('#tambahPesanan').on('submit',function(){
			$('#pesananModal').hide();
			$('#modalProsesTambah').modal('show');
		})
		$('.formTambahStok').on('submit',function(){
			$('#stokBarang').modal('hide');
			$('#modalProsesTambah').modal('show');
		})
		
		$('.stok').mask('000')
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	});
</script>
