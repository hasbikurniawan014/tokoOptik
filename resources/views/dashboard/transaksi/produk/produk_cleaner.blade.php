<table class="table table-sm table-hover table-striped table-bordered">
	<tr>
		<th>Kode Produk</th>
		<th>Jenis</th>
		<th>Merk</th>
		<th>volume</th>
		<th>periode</th>
		<th>Untuk</th>
		<th>Harga</th>
		<th width="1">Jumlah</th>
		<th >Keterangan</th>
		<th ></th>
	</tr>
	<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="tambahBarang">
		@csrf
		<input type="hidden" name="kode_master_produk" value="{{$data_item->kode_produk}}" >
		<input type="hidden" name="harga" value="{{$data_item->harga_jual}}">
		<input type="hidden" name="nama_barang" value="{{$data_item->merk}}">
		<input type="hidden" name="jenis" value="PBC">
		<textarea name="keterangan[]" hidden="" class="form-control">
			Volume:{{$data_item->volume}} Ml# Periode:{{$data_item->periode}} Bulan
		</textarea>
	<tr>
		<td class="align-middle">{{$data_item->kode_produk}}</td>
		<td class="align-middle">Cleaner</td>
		<td class="align-middle">{{$data_item->merk}}</td>
		<td class="align-middle">{{$data_item->volume}}</td>
		<td class="align-middle">{{$data_item->periode}} Bulan</td>
		<td class="align-middle">{{$data_item->jenis}}</td>
		<td class="align-middle" >Rp <span  class="harga">{{$data_item->harga_jual}}</span>,-</td>
		<td>
			<input type="text" name="jumlah" class="form-control" required="" value="1" maxlength="2">
		</td>
		<td>
			<input type="text" name="keterangan[]" class="form-control" >
		</td>
		<td>
			<button class="btn btn-outline-success btn-block" type="submit">
				<i class="fa fa-plus mr-2"></i> <i class="fa fa-shopping-bag"></i>
			</button>
		</td>
	</tr>
	</form>
</table>