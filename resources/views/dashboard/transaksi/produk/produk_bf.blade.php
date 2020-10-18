<div class="table-responsive">
<table class="table table-sm table-hover table-striped table-bordered">
	<tr class="bg-light text-center">
		<th></th>		
		<th></th>		
		<th></th>		
		<th colspan="2">Lensa</th>		
		<th colspan="3">Silinder</th>	
		<th></th>	
		<th></th>	
		<th></th>	
		<th></th>	
	</tr>
	<tr class="text-center">
		<th class="align-middle">Jenis</th>
		<th class="align-middle">Merk</th>
		<th class="align-middle">Type</th>
		<th class="font-weight-bold">Kanan</th>
		<th class="font-weight-bold">Kiri</th>
		<th class="font-weight-bold">Kanan</th>
		<th class="font-weight-bold">Kiri</th>
		<th class="font-weight-bold">Axis</th>
		<th width="100" class="align-middle text-center">Harga</th>
		<th width="1" class="align-middle">Jumlah</th>
		<th width="110" class="align-middle" >Keterangan</th>
		<th ></th>
	</tr>
	<form action="{{route('transaksi.tambah_item',$data_transaksi->kode_penjualan)}}" method="POST" class="tambahBarang">
		@csrf
		<input type="hidden" name="kode_master_produk" value="{{$data_item->fg_kode_produk_bf}}" >
		<input type="hidden" name="harga" value="{{$data_item->harga_jual}}">
		<input type="hidden" name="nama_barang" value="{{$data_item->table_lensa_bf->merk}}">
		<input type="hidden" name="jenis" value="PBB">
		<textarea name="keterangan[]"  hidden=""  rows="10"  class="form-control">
			{{$data_item->table_kategori_lensa->kategori}}#
			{{$data_item->table_type_lensa->type_lensa}}#
			Ukuran R :{{$data_item->table_lensa_bf->lensa_kanan}}#
			Ukuran L :{{$data_item->table_lensa_bf->lensa_kiri}}#

			CYL R :{{$data_item->table_lensa_bf->silinder_kanan}}#
			CYL L :{{$data_item->table_lensa_bf->silinder_kiri}}#
			Axis :{{$data_item->table_lensa_bf->axis}}#
			add :{{$data_item->table_lensa_bf->add}}#
	
			
		</textarea>
	<tr>

		<td class="align-middle text-center">Bifokal</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->merk}}</td>
		<td class="align-middle text-center">{{$data_item->table_type_lensa->type_lensa}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->lensa_kanan}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->lensa_kiri}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->silinder_kanan}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->silinder_kiri}}</td>
		<td class="align-middle text-center">{{$data_item->table_lensa_bf->axis}}</td>
		{{-- <td class="align-middle text-center">{{$data_item->table_lensa_bf->}}</td> --}}
		<td class="align-middle text-center" >Rp <span  class="harga">{{$data_item->harga_jual}}</span>,-</td>
		<td class="align-middle">
			<input type="text" name="jumlah" class="form-control" required="" value="1" maxlength="2">
		</td>
		<td class="align-middle">
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
</div>