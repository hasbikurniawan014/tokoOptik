<form action="{{route('frame.store')}}" method="POST" id="storeFrame" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahFrame">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Frame
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" >
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="">
					</div>
					<div class="form-group">
						<label for="">Harga Jual </label>
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="btn btn-sm btn-white">Rp</span>
							</span>
							<input type="text" name="harga_jual" maxlength="10"  class="form-control harga	" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok"  class="form-control stok stok_barang" required="">
									<span class="input-group-prepend">
										<button class="btn btn-outline-primary">Lusin</button>
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
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Frame Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($frame as $data_Frame)
<form action="{{route('frame.update',$data_Frame->kode_produk)}}" method="POST" id="updateFrame{{$data_Frame->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahframe{{$data_Frame->kode_produk}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Frame
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" class="form-control" required autocomplete="off" maxlength="15" required="" value="{{$data_Frame->kode_produk}}">
					</div>
					<div class="form-group">
						<label for="">merk </label>
						<input type="text" name="merk" class="form-control" maxlength="25"  required="" value="{{$data_Frame->merk}}">
					</div>
					<div class="form-group">
						<label for="">Harga Jual </label>
						<div class="input-group">
							<span class="input-group-prepend">
								<span class="btn btn-sm btn-white">Rp</span>
							</span>
							<input type="text" name="harga_jual" maxlength="10"  class="form-control harga	" required="" value="{{$data_Frame->harga_jual}}">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm">
								<label for="">Stok</label>
								<div class="input-group">
									<input type="text" name="stok" class="form-control stok stok_barang" required="" value="{{$data_Frame->stok/12}}">
									<span class="input-group-prepend">
										<span class="btn btn-outline-primary">Lusin</span>
									</span>
								</div>
							</div>
							<div class="col-sm">
								<label>item</label>
								<input type="text" readonly="" name="item" class="form-control item" value="{{$data_Frame->stok}}">
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
<form action="{{route('frame.update',$data_Frame->kode_produk)}}" method="POST" id="deleteFrame{{$data_Frame->kode_produk}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusframe{{$data_Frame->kode_produk}}">
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
		$('#updateFrame{{$data_Frame->kode_produk}}').on('submit',function(){
			$('#ubahframe{{$data_Frame->kode_produk}}').modal('hide');
			$('#modalProsesUbah').modal('show');
		})

		$('#deleteFrame{{$data_Frame->kode_produk}}').on('submit',function(){
			$('#hapusframe{{$data_Frame->kode_produk}}').modal('hide');
			$('#modalProsesHapus').modal('show');
		})
	})
</script>
@endforeach

