	<h5><i class="fa fa-shopping-bag mr-2 text-success"></i>Nomor Pesanan : {{$data_pesanan->kode_pesanan}}</h5>
	<hr style="background: black">
	<a href="{{route('home')}}" class="p-2 "><i class="fa fa-arrow-left mr-2"></i> Kembali</a> <br> <br>
		<h5><i class="fa fa-shopping-bag mr-2 text-success "></i>Daftar Item pesanan</h5>
		 <table class="table table-sm  w-50">
		 	<tr>
		 		<th>Nama Pemesan</th>
		 		<td>{{$data_pesanan->nama_pembeli}}</td>	
		 	</tr>
		 	<tr>
		 		<th>Tanggal Pesan</th>
		 		<td>{{date('d F Y', strtotime($data_pesanan->tgl_pesan))}}</td>	
		 	</tr>
		 	<tr>
		 		<th>Tanggal Pengambilan</th>
		 		<td>{{date('d F Y', strtotime($data_pesanan->tgl_selesai))}}</td>	
		 	</tr>
		 </table>
	<table class="table table-sm table-hover table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Produk</th>
				<th>Pesanan</th>
				<th>Qty</th>
				<th>Harga</th>
				<th>Total Harga</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data_pesanan->table_item_pesanan as $item)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$item->kode_produk}}</td>
				<td>{{$item->pesanan}}</td>
				<td>{{$item->jumlah}}</td>
				<td>Rp <span  class="harga">{{$item->harga/$item->jumlah}}</span></td>
				<td>Rp <span  class="harga">{{$item->harga}}</span></td>
				<td>
					@if($item->keterangan)
					<?php $data=explode('#',$item->keterangan)?>
					@foreach($data as $dataket)
						<div class="p-1 border border m-1" style="display: inline-block;">{{$dataket}}</div>
					@endforeach
					@else
					<i>Tidak ada keterangan </i>
					@endif
				</td>
			</tr>

			@endforeach
		</tbody>
	</table>

	<h4>
		<div class="row">
			<div class="col-sm">
			<div class="mb-3"> <i class="fa fa-money text-success mr-2"></i> 
				Total Harga 
			</div>
				Rp <span >
					{{number_format($data_pesanan->table_item_pesanan->sum('harga')) }}
				</span> ,-
			</div>
			<div class="col-sm">
				<div class="mb-3">Sisa wajib dibayarkan</div>
				Rp <span >
					{{number_format($data_pesanan->table_item_pesanan->sum('harga')/2) }}
				</span>
			</div>
			<div class="col-sm">
				<div class="m-3">
					<a href="{{route('pesanan.pdf',$data_pesanan->kode_pesanan)}}" class="btn btn-primary btn-block" s><i class="fa fa-print mr-2"></i>Print Nota Pesanan</a>
				</div>
				<div class="m-3">
					<button  class="btn btn-success btn-block" data-toggle="modal"  data-target="#pembayaran"><i class="fa fa-money mr-2 "></i>Pelunasan Pembayaran</button>
				</div>
			</div>
		</div>
	</h4>

<form action="{{route('pesanan.pembayaran',$data_pesanan->kode_pesanan)}}" method="POST" id="storePembayaran">
<div class="modal fade" id="pembayaran">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pembayaran & Pelunasan pesanan</h5>
			</div>
			@csrf
			{{method_field('PUT')}}
				<div class="modal-body">
					<table class="table table-sm table-hover table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Produk</th>
									<th>Pesanan</th>
									<th>Qty</th>
									<th>Harga</th>
									<th>Total Harga</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data_pesanan->table_item_pesanan as $item)
								<tr>
									<input type="text" hidden="" name="kode_produk[]" value="{{$item->kode_produk}}">
									<input type="text" hidden="" name="pesanan[]" value="{{$item->pesanan}}">
									<input type="text" hidden="" name="jumlah[]" value="{{$item->jumlah}}">
									<input type="text" hidden="" name="harga[]" value="{{$item->harga}}">
									<input type="text" hidden="" name="keterangan[]" value="{{$item->keterangan}}">

									<td>{{$loop->iteration}}</td>
									<td>{{$item->kode_produk}}</td>
									<td>{{$item->pesanan}}</td>
									<td>{{$item->jumlah}}</td>
									<td>Rp <span  class="harga">{{$item->harga/$item->jumlah}}</span></td>
									<td>Rp <span  class="harga">{{$item->harga}}</span></td>
			
									<td>
										@if($item->keterangan)
											<?php $data=explode('#',$item->keterangan)?>
											@foreach($data as $dataket)
												<div class="p-1 border border m-1" style="display: inline-block;">{{$dataket}}</div>
											@endforeach
										@else
										<i>Tidak ada keterangan </i>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
					</table>
					<h5>Sisa pembayaran <br>
						Rp 
						<span > 
							{{number_format($data_pesanan->table_item_pesanan
								->where('fg_kode_pesanan',$data_pesanan->kode_pesanan)->sum('harga') / 2) }}
						</span>
					</h5>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit"><i class="fa fa-money mr-2"></i>Terima pembayaran</button>
					<button class="btn btn-secondary " data-dismiss="modal"></i>Batal</button>
				</div>
		</div>
	</div>
</div>
</form>

