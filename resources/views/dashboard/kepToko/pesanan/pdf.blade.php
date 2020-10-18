<html>
	<head>
		<style>
		body{
			font-stretch: 0.9rem;
		}
			.table, .th, .td {
			  border: 1px solid #c8d6e5;
			}
	 .th,.td{
	 	/*padding: 4px;*/
	 }
	 /*tr:nth-child(even) {background-color: #f2f2f2;}*/
		</style>
	</head>
	<body style="" ="width: 100%">
		<p style="text-align: center"><span style="font-size: 25px; font-weight: bold;">Maranti Optik</span>
			<p style="text-align: center; margin-top: -10px margin-bottom:-10px; text-transform: capitalize" >Jl. Abdul Wahab Rt 04/08 Kedaung, Sawangan, Depok.</p>
		<hr style="background: black">
		</p>
		<table>
			<tr>
				<th>Tanggal pemesanan  </th>
				<td>  {{$data_pesanan->created_at->format('d F Y')}}</td>
					<th>
						<th>Nama Pemesan </th>
						<td> {{$data_pesanan->nama_pembeli}}</td>	
						
					</th>
			</tr>
			<tr>
				<th>Tanggal pengambilan   </th>
				<td width="200">{{ date('d F Y', strtotime($data_pesanan->tgl_selesai))}}</td>
				<th>
					<th>Nota Pemesanan </th>
					<td> {{$data_pesanan->kode_pesanan}}</td>s
				</th>
			</tr>
		</table>


	<table class="table" style="width: 100%; border-collapse: collapse;">
		<tr style="border: 1px dotted #c8d6e5; background: #c8d6e5;  text-align: center">
			<th class="th" style="padding: 5px;">No</th>
			<th class="th" style="padding: 5px;">Kode Produk</th>
			<th>Pesanan</th>
			<th class="th" style="text-align: center;">Harga</th>
			<th class="th" style="text-align: center;">Qty</th>
			<th class="th" style="text-align: center;">Total Harga</th>
			<th class="th" style="text-align: center;">Keterangan</th>
		</tr>
		@foreach($data_pesanan->table_item_pesanan as $item)	
			<tr style="border: 1px solid black;">
				<td class="td" style="text-align: center; padding: 15px">{{$loop->iteration}}</td>
				<td class="td" style=" padding: 15px"><small>{{$item->kode_produk}}</small></td>
				<td class="td" style=" padding: 15px">{{$item->pesanan}}</td>
				<td class="td" style="text-align: center; padding: 15px">
					Rp {{number_format($item->harga / $item->jumlah)}}
				</td>
				<td class="td" style="text-align: center; padding: 15px">{{$item->jumlah}}</td>
				<td class="td" style="text-align: center; padding: 15px">
					Rp {{number_format($item->harga)}}
				</td>
				<td class="td">
					<?php $data=explode('#',$item->keterangan)?>
					@foreach($data as $dataket)
					 <div class="td" style="padding: 2px; border:1px #c8d6e5; font-size: 12px">{{$dataket}}</div>
					@endforeach
				</td>
			</tr>
		@endforeach
	</table>
	<h5>Total Pembayarn : </h5>
	<h3>Rp {{number_format($data_pesanan->table_item_pesanan->where('fg_kode_pesanan',$data_pesanan->kode_pesanan)->sum('harga'))}}</span>,-</h3>
	</body>
</html>