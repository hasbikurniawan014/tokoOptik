<table class="table table-sm table-hover table-striped table-bordered">
	<tr>
		<th width="1">Kode</th>
		<th width="1">Jenis</th>
		<th width="1">Merk</th>
		<th width="1">Warna</th>
		<th>Harga</th>
		<th width="1">ukuran</th>
		<th>Periode</th>
		<th width="1">Jumlah</th>
		<th  width="100">Keterangan</th>
		<th ></th>
	</tr>
	<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="tambahBarang">
		@csrf
		<input type="hidden" name="kode_master_produk" value="{{$data_item->kode_produk}}" >
		<input type="hidden" name="harga" value="{{$data_item->harga_jual}}">
		<input type="hidden" name="nama_barang" value="{{$data_item->merk}}">
		<input type="hidden" name="jenis" value="PBS">
		<textarea name="keterangan[]" hidden="" class="form-control">
			Ukuran:{{$data_item->ukuran}}# Periode:{{$data_item->periode}} Bulan # Warna : {{ucfirst($data_item->warna)}}
		</textarea>
	<tr>
		<td class="align-middle">{{$data_item->kode_produk}}</td>
		<td class="align-middle">Softlens</td>
		<td class="align-middle">{{$data_item->merk}}</td>
		<td class="align-middle">{{ucfirst($data_item->warna)}}</td>
		<td class="align-middle" >Rp <span  class="harga">{{$data_item->harga_jual}}</span>,-</td>
		<td class="align-middle" >{{$data_item->ukuran}}</td>
		<td class="align-middle" >{{$data_item->periode}} Bulan</td>
		<td>
			<input type="text" name="jumlah" class="form-control" required="" value="1" maxlength="2">
		</td>
		<td>
			<input type="text" name="keterangan[]" class="form-control" >
		</td>
	<td>
			<button class="btn btn-outline-success btn-block" type="submit">
				<i class="fa fa-plus mr-2"></i>  <i class="fa fa-shopping-bag"></i>
			</button>
		</td>
	</tr>
	</form>
</table>