<form action="{{route('lensaSv.store')}}" method="POST" id="storeLensa" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahLensa">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Lensa
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16">
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-5  border border p-2 m-2">
								<p for="" class="text-center">Ukuran lensa</p>
								<div class="row text-center">
									<div class="col-sm">
										<small>Kiri</small>
										<input type="text" class="form-control" name="lensa_kiri" required="" maxlength="6">	
									</div>
									<div class="col-sm">
										<small>kanan</small>
										<input type="text" class="form-control" name="lensa_kanan" required="" maxlength="6">	
									</div>
								</div>
							</div>
							<div class="col-sm  border border p-2 m-2">
								<p class="text-center">Silinder</p>
								<div class="row text-center">
									<div class="col-sm">
										<small>Kiri</small>
										<input type="text" class="form-control" name="silinder_kiri" required="" maxlength="6">	
									</div>
									<div class="col-sm">
										<small>Kanan</small>
										<input type="text" class="form-control" name="silinder_kanan" required="" maxlength="6">
									</div>
									<div class="col-sm">
										<small>Axis</small>
										<input type="text" class="form-control" name="axis" required="" maxlength="3">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Type Lensa</label>
						<select name="type" id="" class="form-control">
							@foreach($type as $data_type)
							<option value="{{$data_type->kode_type_lensa}}">{{$data_type->type_lensa}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Harga Jual </label>
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="btn btn-sm btn-white">Rp</span>
							</span>
							<input type="text" name="harga_jual"  class="form-control harga	" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok"  class="form-control stok stok_barang" required="">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Lusin</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label>item</label>
								<input type="text" readonly="" name="item" class="form-control item" required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Lensa Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($lensa as $data_Lensa)
<form action="{{route('lensaSv.update',$data_Lensa->fg_kode_produk_sv)}}" method="POST" id="updateLensa{{$data_Lensa->fg_kode_produk_sv}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahLensa{{$data_Lensa->fg_kode_produk_sv}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Lensa
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16" value="{{$data_Lensa->fg_kode_produk_sv}}">
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="" value="{{$data_Lensa->table_lensa_sv->merk}}">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-5  border border p-2 m-2">
								<p  class="text-center">Ukuran lensa</p>
								<div class="row text-center">
									<div class="col-sm">
										<small>Kiri</small>
										<input type="text" class="form-control" name="lensa_kiri" required="" maxlength="6" value="{{$data_Lensa->table_lensa_sv->lensa_kiri}}">	
									</div>
									<div class="col-sm">
										<small>kanan</small>
										<input type="text" class="form-control" name="lensa_kanan" required="" maxlength="6" value="{{$data_Lensa->table_lensa_sv->lensa_kanan}}">	
									</div>
								</div>
							</div>
							<div class="col-sm  border border p-2 m-2">
								<p class="text-center">Silinder</p>
								<div class="row text-center">
									<div class="col-sm">
										<small>Kiri</small>
										<input type="text" class="form-control" name="silinder_kiri" required="" maxlength="6" value="{{$data_Lensa->table_lensa_sv->silinder_kiri}}">	
									</div>
									<div class="col-sm">
										<small>Kanan</small>
										<input type="text" class="form-control" name="silinder_kanan" required="" maxlength="6" value="{{$data_Lensa->table_lensa_sv->silinder_kanan}}">
									</div>
									<div class="col-sm">
										<small>Axis</small>
										<input type="text" class="form-control" name="axis" required="" maxlength="3" value="{{$data_Lensa->table_lensa_sv->axis}}">
									</div>
								</div>
							</div>
						</div>
					</div>  
					<div class="form-group">
						<label for="">Type Lensa</label>
						<select name="type" id="" class="form-control">
							@foreach($type as $data_type)
							<option value="{{$data_type->kode_type_lensa}}">{{$data_type->type_lensa}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Harga Jual </label>
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="btn btn-sm btn-white">Rp</span>
							</span>
							<input type="text" name="harga_jual"  class="form-control harga	" required="" value="{{$data_Lensa->harga_jual}}">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok" class="form-control stok stok_barang" required="" value="{{$data_Lensa->stok/12}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Lusin</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label>item</label>
								<input type="text" readonly="" name="item" class="form-control item" value="{{$data_Lensa->stok}}" required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Karyawn</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('lensaSv.destroy',$data_Lensa->fg_kode_produk_sv)}}" method="POST" id="deleteLensa{{$data_Lensa->fg_kode_produk_sv}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusLensa{{$data_Lensa->fg_kode_produk_sv}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body">
					Apakah Anda yakin ingin menghapus data ini ?
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger btn-block btn-sm"><i class="fa fa-trash mr-2"></i>Ya </button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
		$('#updateLensa{{$data_Lensa->fg_kode_produk_sv}}').on('submit',function(){
			$('#ubahLensa{{$data_Lensa->fg_kode_produk_sv}}').modal('hide');
			$('#modalProsesUbah').modal('show');
		})

		$('#deleteLensa{{$data_Lensa->fg_kode_produk_sv}}').on('submit',function(){
			$('#hapusLensa{{$data_Lensa->fg_kode_produk_sv}}').modal('hide');
			$('#modalProsesHapus').modal('show');
		})	
	})



</script>
@endforeach

