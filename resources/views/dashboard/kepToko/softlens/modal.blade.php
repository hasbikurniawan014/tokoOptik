<form action="{{route('softlens.store')}}" method="POST" id="storeSoftlens" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahSoftlens">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Softlens
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
							<div class="col-sm">
								<label for="">Warna Lensa</label>
								<input type="text" name="warna" class="form-control warna" required="" maxlength="8" autocomplete="off">
							</div>
							<div class="col-sm">
								<label for="">Ukuran lensa</label>
								<input type="text" name="ukuran" class="form-control ukuran" required="" maxlength="6" autocomplete="off">
							</div>
							<div class="col-sm">
								<label for="">Periode Pakai</label>
								<div class="input-group">
									<input type="text" name="periode" class="form-control periode" required="" maxlength="2" autocomplete="off">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Bulan</span>
									</span>
								</div>
							</div>
						</div>
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
								<input type="text" readonly="" name="item" class="form-control item">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Softlens Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($softlens as $data_Softlens)
<form action="{{route('softlens.update',$data_Softlens->kode_produk)}}" method="POST" id="updateSoftlens{{$data_Softlens->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahSoftlens{{$data_Softlens->kode_produk}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Softlens
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16" value="{{$data_Softlens->kode_produk}}">
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="" value="{{$data_Softlens->merk}}">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Warna Lensa</label>
								<input type="text" name="warna" class="form-control warna" required="" maxlength="8" autocomplete="off" value="{{$data_Softlens->warna}}">
							</div>
							<div class="col-sm">
								<label for="">Ukuran lensa</label>
								<input type="text" name="ukuran" class="form-control ukuran" required="" maxlength="6" autocomplete="off" value="{{$data_Softlens->ukuran}}">
							</div>
							<div class="col-sm">
								<label for="">Periode Pakai</label>
								<div class="input-group">
									<input type="text" name="periode" class="form-control periode" required="" maxlength="2" autocomplete="off" value="{{$data_Softlens->periode}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Bulan</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Harga Jual </label>
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="btn btn-sm btn-white">Rp</span>
							</span>
							<input type="text" name="harga_jual"  class="form-control harga	" required="" value="{{$data_Softlens->harga_jual}}">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok" class="form-control stok stok_barang" required="" value="{{$data_Softlens->stok/12}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Lusin</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label>item</label>
								<input type="text" readonly="" name="item" class="form-control item" value="{{$data_Softlens->stok}}">
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
<form action="{{route('softlens.update',$data_Softlens->kode_produk)}}" method="POST" id="deleteSoftlens{{$data_Softlens->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusSoftlens{{$data_Softlens->kode_produk}}">
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
	$('#updateSoftlens{{$data_Softlens->kode_produk}}').on('submit',function(){
		$('#ubahSoftlens{{$data_Softlens->kode_produk}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deleteSoftlens{{$data_Softlens->kode_produk}}').on('submit',function(){
		$('#hapusSoftlens{{$data_Softlens->kode_produk}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})

</script>
@endforeach

