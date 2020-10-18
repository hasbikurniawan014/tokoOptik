<table class="table table-sm  table-striped table-bordered">
	<tr class="text-center bg-light">
		<th></th>
		<th></th>
		<th></th>
		<th colspan="2">Lensa</th>
		<th colspan="2">Silinder</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<tr>
		<th class="align-middle text-center">Jenis</th>
		<th class="align-middle text-center">Merk</th>
		<th class="align-middle text-center">Type</th>
			<th class="align-middle text-center">Kiri</th>
			<th class="align-middle text-center">Kanan</th>
			<th class="align-middle text-center">Kiri</th>
			<th class="align-middle text-center">Kanan</th>
		<th class="align-middle text-center">Harga</th>
		<th class="align-middle text-center" width="1">Jumlah</th>
		<th class="align-middle text-center" width="200" >Keterangan</th>
		<th ></th>
	</tr>
	<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="tambahBarang">
		@csrf
		<input type="hidden" name="kode_master_produk" value="{{$data_item->fg_kode_produk_sv}}" >
		<input type="hidden" name="harga" value="{{$data_item->harga_jual}}">
		<input type="hidden" name="nama_barang" value="{{$data_item->table_lensa_sv->merk}}">
		<input type="hidden" name="jenis" value="PBV">
		<textarea name="keterangan[]"  hidden=""  class="form-control">
			{{$data_item->table_type_lensa->type_lensa}}#
			Ukuran R :{{$data_item->table_lensa_sv->lensa_kanan}}#
			Ukuran L :{{$data_item->table_lensa_sv->lensa_kiri}}#
			CYL R :{{$data_item->table_lensa_sv->silinder_kanan}}#
			CYL L:{{$data_item->table_lensa_sv->silinder_kiri}}#
			Axis:{{$data_item->table_lensa_sv->axis}}#
		</textarea>
	<tr class="table-hover">
		{{-- <td class="align-middle">{{$data_item->fg_kode_produk_sv}}</td> --}}
		<td class="align-middle text-center">Singgle Vision</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_sv->merk}}</td>
		<td class="align-middle text-center">{{$data_item->table_type_lensa->type_lensa}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_sv->lensa_kiri}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_sv->lensa_kanan}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_sv->silinder_kiri}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_sv->silinder_kanan}}</td>
		<td  width="100" class="align-middle text-center" >Rp <span  class="harga">{{$data_item->harga_jual}}</span>,-</td>
		<td class="align-middle">
			<input type="text" name="jumlah" class="form-control" required="" value="1" maxlength="2">
		</td>
		<td class="align-middle">
			<input type="text" name="keterangan[]" class="form-control" >
		</td>
		<td class="align-middle">
			<button class="btn btn-outline-success btn-block" type="submit">
				<i class="fa fa-plus mr-2"></i> <i class="fa fa-shopping-bag"></i>
			</button>
		</td>
	</tr>
	</form>
</table>

