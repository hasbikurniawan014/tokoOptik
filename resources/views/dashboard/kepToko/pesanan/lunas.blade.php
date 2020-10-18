	<h5><i class="fa fa-shopping-bag mr-2 text-success"></i>Nomor Pesanan : {{$data_pesanan->kode_pesanan}}</h5>
	<hr style="background: black">
	<a href="{{route('home')}}" class="p-2 "><i class="fa fa-arrow-left mr-2"></i> Kembali</a> <br> <br>
		<h5><i class="fa fa-shopping-bag mr-2 text-success "></i>Daftar Item pesanan</h5>
		 <table class="table table-sm  w-25">
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
						<div class=" border border m-1" style="display: inline-block;">{{$dataket}}</div>
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
				Rp <span class="harga">
					{{$data_pesanan->table_item_pesanan->sum('harga')}}
				</span> ,-
			</div>
			<div class="col-sm">
				Status : 
				<div class=" p-3 text-success"><i class="fa fa-check  mr-2"></i> Lunas</div>
			</div>
			<div class="col-sm">
				<div class="m-3">
					<a href="{{route('pesanan.pdf',$data_pesanan->kode_pesanan)}}" class="btn btn-primary btn-block" s><i class="fa fa-print mr-2"></i>Print Nota Pesanan</a>
				</div>
				<div class="m-3">
					<a href="{{route('transaksi.index',$data_pesanan->kode_pesanan)}}"  class="btn btn-success btn-block"><i class="fa fa-money mr-2 "></i>Pesanan Telah Lunas</a>
				</div>
			</div>
		</div>
	</h4>