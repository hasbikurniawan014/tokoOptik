<html>
	<head>
		<style>
		body{
			font-stretch: 0.9rem;
		}
			table, th, td {
			  border: 1px solid #c8d6e5;
			}
	 th,td{
	 	padding: 4px;
	 }
	 /*tr:nth-child(even) {background-color: #f2f2f2;}*/
		</style>
	</head>
	<body style="width: 100%">
		<p style="text-align: center"><span style="font-size: 25px; font-weight: bold;">Maranti Optik</span>
			<p style="text-align: center; margin-top: -10px margin-bottom:-10px; text-transform: capitalize" >Jl. Abdul Wahab Rt 04/08 Kedaung, Sawangan, Depok.</p>
		<hr style="background: black">
		</p>
		

	<h5>
		<span>Pelanggan : {{ucfirst($data_transaksi->nama_pembeli)}}</span> <br>
		Nota Pembayaran : {{$data_transaksi->kode_penjualan}}  
		<span style="float: right;">Tanggal : {{$data_transaksi->created_at->format('d F Y')}} </span>
	</h5>
	<table  style="width: 100%; border-collapse: collapse;" >
		<tr style="  background: #c8d6e5;">
			<th width="1" style="/*padding: 10px;*/text-align: center; ">No</th>
			<th width="1" style="/*padding: 10px;*/text-align: center; ">Kode Barang</th>
			<th width="1" style="/*padding: 10px;*/text-align: center; ">Jenis</th>
			<th width="1" style="/*padding: 10px;*/text-align: center;  " >Merk </th>
			<th width="1" style="text-align: center;">Harga</th>
			<th width="1" style="text-align: center; width: 1px">Qty</th>
			<th width="1" style="text-align: center;">Total Harga</th>
			<th  width="1" style="text-align: center; ">Keterangan</th>
		</tr>
		@foreach($data_transaksi->table_item_terjual as $item)	
			<tr style="">
				<td width="1" style="text-align: center;">{{$loop->iteration}}</td>
				<td width="1" style="text-align: center"><small>{{$item->kode_master_produk}}</small></td>
				<td width="1" style="text-align: center">
						@if($item->jenis_produk == 'PBB')
							<small>Bifokal</small>
						@elseif($item->jenis_produk == 'PBV')
							<small>Singgle Vision</small>
						@elseif($item->jenis_produk == 'PBC')
							<small>Pembersih</small>
						@elseif($item->jenis_produk == 'PBF')
							<small>Frame</small>
						@elseif($item->jenis_produk == 'PBS')
							<small>Softlens</small>
						@else
							<small>Jasa</small>
						@endif
				</td>
				<td width="1" style="text-align: center">{{$item->nama_barang}}</td>
				<td width="1" style="text-align: center;">
					<span style="display: inline; font-size: 10px">Rp</span> {{number_format($item->total_harga_item / $item->banyak_item)}}
				</td>
				<td width="1"width="1" style="text-align: center;">{{$item->banyak_item}}</td>
				<td width="1"width="1"  style="text-align: center;">
					Rp{{number_format($item->total_harga_item)}}
				</td>
				<td width="1">
					<?php $data_ket=explode('#', $item->keterangan) ?>
					@foreach($data_ket as $ket)
						<span style="font-size: 12px">{{$ket}}</span> <br>
					@endforeach
				</td>
			</tr>
		@endforeach
			{{-- <td></td>
			<td></td>
			<td style="text-align: center; background: #c8d6e5; padding: 5px"> TOTAL PEMBAYARAN</td>
			<td></td>
			<td></td>
			<td style="text-align: center; background: #c8d6e5; padding: 5px;">
				Rp {{number_format($data_transaksi->table_item_terjual->where('fg_kode_penjualan',$data_transaksi->kode_penjualan)->sum('total_harga_item'))}}</span>,-
			</td> --}}
	</table>
	<div style="float: right; margin-top: 10px;">
		<p style="font-size: 15px; font-weight: bold">Total Pembayaran</p>
		<p style="font-size: 20px">Rp  <span>{{number_format($data_transaksi->table_item_terjual->where('fg_kode_penjualan',$data_transaksi->kode_penjualan)->sum('total_harga_item'))}}</span>,-</p>
	</div>
	</body>
</html>