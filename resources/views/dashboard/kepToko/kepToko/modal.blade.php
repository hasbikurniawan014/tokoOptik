<form action="{{route('kepToko.store')}}" method="POST" id="storekepToko" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahkepToko">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Kepala Toko
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama </label>
						<input type="text" name="nama" class="form-control" required autocomplete="off" maxlength="30" required="">
					</div>
					<div class="form-group">
						<label for="">Email </label>
						<input type="email" name="email" class="form-control" maxlength="30" placeholder="Boleh kosong">
					</div>
					<div class="form-group">
						<label for="">Tanggal lahir </label>
						<input type="text" name="tgl_lahir" class="form-control tanggal" autocomplete="off" maxlength="11" required="">
					</div>
					<div class="form-group">
						<label for="">Kelamin</label>
						<div class="form-group">
							<div class="row text-center">
								<div class="col">
									<input type="radio" value="L" name="kelamin" class="mr-2" required=""> 
									<label for="">Laki laki</label>	
								</div>
								<div class="col">
									<input type="radio" value="P" name="kelamin" class="mr-2" required="">
									<label for="">Perempuan</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="alamat" class="form-control" required="" maxlength="100"></textarea>
					</div>
					<div class="form-group">
						<label for="">Tambahkan Foto Kepala Toko</label>
						<input type="file" name="foto" required="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Data Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($kepToko as $data_kepToko)
<form action="{{route('kepToko.update',$data_kepToko->fg_kepala_toko)}}" method="POST" id="updatekepToko{{$data_kepToko->fg_kepala_toko}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahkepToko{{$data_kepToko->fg_kepala_toko}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Kepala Toko
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama </label>
						<input type="text" name="nama" class="form-control" required autocomplete="off" maxlength="30" required="" value="{{$data_kepToko->table_user->nama}}">
					</div>
					<div class="form-group">
						<label for="">Email </label>
						<input type="email" name="email" class="form-control" maxlength="30" placeholder="Boleh kosong" value="{{$data_kepToko->table_user->email}}">
					</div>
					<div class="form-group">
						<label for="">Tanggal lahir </label>
						<input type="text" name="tgl_lahir" class="form-control tanggal" autocomplete="off" maxlength="11" required=""   value="{{$data_kepToko->tgl_lahir}}">
						<small>Mengubah tanggal lahir berarti mengubah password !</small>
					</div>
					<div class="form-group">
						<label for="">Kelamin</label>
						<select name="kelamin" class="form-control">
							<option value="{{$data_kepToko->kelamin}}" selected="" hidden="" >
								{{$data_kepToko->kelamin}}
							</option>
							<option value="L">Laki Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="alamat" class="form-control" required="" maxlength="100">{{$data_kepToko->alamat}}
						</textarea>
					</div>
					<div class="form-group">
						<label for="">Tambahkan Foto kepToko</label>
						<small>Kosongkan jika tidak mengubah foto</small>
						<input type="file" name="foto" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Karyawn</button>	
					<button class="btn btn-sm btn-secondary">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('kepToko.update',$data_kepToko->fg_kepala_toko)}}" method="POST" id="deletekepToko{{$data_kepToko->fg_kepala_toko}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapuskepToko{{$data_kepToko->fg_kepala_toko}}">
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
	$('#updatekepToko{{$data_kepToko->fg_kepala_toko}}').on('submit',function(){
		$('#ubahkepToko{{$data_kepToko->fg_kepala_toko}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deletekepToko{{$data_kepToko->fg_kepala_toko}}').on('submit',function(){
		$('#hapuskepToko{{$data_kepToko->fg_kepala_toko}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})
</script>
@endforeach

