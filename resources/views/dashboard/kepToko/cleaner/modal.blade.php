<form action="{{route('cleaner.store')}}" method="POST" id="storeCleaner" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahCleaner">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Cleaner
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
								<label for="">Jenis Cleaner</label>
								<select name="jenis" id="" class="form-control">
									<option value="Lensa">Lensa</option>
									<option value="Softlens">Softlens</option>
								</select>
							</div>
							<div class="col-sm">
								<label for="">Volume</label>
								<div class="input-group">
									<input type="text" name="volume" class="form-control volume" required="" maxlength="3" autocomplete="off">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Mili</span>
									</span>
								</div>
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
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Cleaner Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($cleaner as $data_Cleaner)
<form action="{{route('cleaner.update',$data_Cleaner->kode_produk)}}" method="POST" id="updateCleaner{{$data_Cleaner->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahCleaner{{$data_Cleaner->kode_produk}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Cleaner
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" maxlength="16" value="{{$data_Cleaner->kode_produk}}">
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="" value="{{$data_Cleaner->merk}}">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Jenis Cleaner</label>
								<select name="jenis" id="" class="form-control">
									<option value="{{$data_Cleaner->jenis}}" selected="" hidden="">{{$data_Cleaner->jenis}}</option>
									<option value="Lensa">Lensa</option>
									<option value="Softlens">Softlens</option>
								</select>
							</div>
							<div class="col-sm">
								<label for="">Volume</label>
								<div class="input-group">
									<input type="text" name="volume" class="form-control volume" required="" maxlength="3" autocomplete="off" value="{{$data_Cleaner->volume}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Mili</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label for="">Periode Pakai</label>
								<div class="input-group">
									<input type="text" name="periode" class="form-control periode" required="" maxlength="2" autocomplete="off" value="{{$data_Cleaner->periode}}">
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
							<input type="text" name="harga_jual"  class="form-control harga	" required="" value="{{$data_Cleaner->harga_jual}}">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok" class="form-control stok stok_barang" required="" value="{{$data_Cleaner->stok/12}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Lusin</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label>item</label>
								<input type="text" readonly="" name="item" class="form-control item" value="{{$data_Cleaner->stok}}">
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
<form action="{{route('cleaner.update',$data_Cleaner->kode_produk)}}" method="POST" id="deleteCleaner{{$data_Cleaner->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusCleaner{{$data_Cleaner->kode_produk}}">
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
		$('#updateCleaner{{$data_Cleaner->kode_produk}}').on('submit',function(){
			$('#ubahCleaner{{$data_Cleaner->kode_produk}}').modal('hide');
			$('#modalProsesUbah').modal('show');
		})

		$('#deleteCleaner{{$data_Cleaner->kode_produk}}').on('submit',function(){
			$('#hapusCleaner{{$data_Cleaner->kode_produk}}').modal('hide');
			$('#modalProsesHapus').modal('show');
		})
	})
</script>
@endforeach

