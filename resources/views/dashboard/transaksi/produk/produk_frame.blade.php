<table class="table table-sm table-hover table-striped table-bordered">
	<tr>
		<th width="1">Kode</th>
		<th width="1">Jenis</th>
		<th>Merk</th>
		<th>Harga</th>
		<th width="1">Jumlah</th>
		<th width="200" >Keterangan</th>
		<th ></th>
	</tr>
	<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="tambahBarang">
		@csrf
		<input type="hidden" name="kode_master_produk" value="{{$data_item->kode_produk}}" >
		<input type="hidden" name="harga" value="{{$data_item->harga_jual}}">
		<input type="hidden" name="nama_barang" value="{{$data_item->merk}}">
		<input type="hidden" name="jenis" value="PBF">
		<textarea name="keterangan[]" hidden="" class="form-control">
		</textarea>
	<tr>
		<td class="align-middle">{{$data_item->kode_produk}}</td>
		<td class="align-middle">FRAME</td>
		<td class="align-middle">{{$data_item->merk}}</td>
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