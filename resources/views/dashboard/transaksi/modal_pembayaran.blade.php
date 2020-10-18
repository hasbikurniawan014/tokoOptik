{{-- modal pembayaran --}}
{{-- route di rformnya juga post --}}
<form action="{{route('transaksi.pembayaran',['id_trans'=> $data_transaksi->kode_penjualan])}}" method="POST">
@csrf
<div class="modal fade" tabindex="-1" id="lakukanPembayaran">
	<div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="fa fa-money text-success mr-2"></i>Pembayaran Transaksi
				</h5>
			</div>
				<div class="modal-body">
					<table class="table table-sm table-light table-hover table-striped">
						<tr class="text-center">
							<th width="1" class="text-center">No</th>
							<th >Kode Barang</th>
							<th >Merk</th>
							<th>Harga</th>
							<th>Qty</th>
							<th>Total Harga</th>
							<th width="400">Keterangan</th>
						</tr>
							@forelse($data_transaksi->table_item_terjual as $item)	
								<tr>
									<input type="hidden" name="jenis[]" value="{{$item->jenis_produk}}">
									<input type="hidden" name="kode_barang[]" value="{{$item->kode_master_produk}}">
									<input type="hidden" name="jumlah[]" value="{{$item->banyak_item}}">
									<td class="align-middle text-center">{{$loop->iteration}}</td>
									<td class="align-middle"><small>{{$item->kode_master_produk}}</small></td>
									<td class="align-middle">{{$item->nama_barang}}</td>
									<td class="align-middle">
										Rp
										<span class="harga">{{$item->total_harga_item / $item->banyak_item}}</span>
									</td>
									<td class="align-middle">{{$item->banyak_item}}</td>
									<td class="align-middle">
										Rp
										<span class="harga">{{$item->total_harga_item}}</span>
									</td>
									<td>
										<?php $data_ket=explode('#', $item->keterangan) ?>
										@foreach($data_ket as $ket)
											<div class="p-1 rounded border border m-1" style="display: inline-block;">{{$ket}}</div>
										@endforeach
									</td>
								</tr>
							@empty
							<div>Tidak ada item</div>
							@endforelse
					</table>
					<div class="h5 float-left">
					<i class="fa fa-money mr-2 text-success"> </i> Total Pembayaran :
						Rp <span class="harga">{{$data_transaksi->table_item_terjual->where('fg_kode_penjualan',$data_transaksi->kode_penjualan)->sum('total_harga_item')}}</span>,-
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-outline-success " type="submit"><i class="fa fa-money mr-2"></i>Uang Diterima</button>
					<button class="btn btn-outline-secondary " type="button" data-dismiss="modal">Batal</button>
				</div>
		</div>
	</div>
</div>
</form>
