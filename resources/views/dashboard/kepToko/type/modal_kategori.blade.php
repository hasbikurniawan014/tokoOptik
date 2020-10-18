<form action="{{route('kategori.store')}}" method="POST" id="storeKategori" type="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahKategori">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Kategori
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kategori Lensa </label>
						<input type="text" name="kategori" class="form-control" maxlength="16"  required="" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Kategori Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($kategori as $data_Kategori)
<form action="{{route('kategori.update',$data_Kategori->kode_kategori_lensa)}}" method="POST" id="updateKategori{{$data_Kategori->kode_kategori_lensa}}" type="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahKategori{{$data_Kategori->kode_kategori_lensa}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Kategori
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kategori Lensa </label>
						<input type="text" name="kategori" class="form-control" maxlength="25"  required="" value="{{$data_Kategori->kategori}}" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Kategori</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('kategori.destroy',$data_Kategori->kode_kategori_lensa)}}" method="POST" id="deleteKategori{{$data_Kategori->kode_kategori_lensa}}" type="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusKategori{{$data_Kategori->kode_kategori_lensa}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body text-center">
					Apakah Anda yakin ingin menghapus data ini ? <br>
					<span class="text-danger text-center">
						Jika anda menghapus kategori ini maka data yang bersangkutan dengan kategori ini ikut terhapus !
					</span>
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
	$('#updateKategori{{$data_Kategori->kode_kategori_lensa}}').on('submit',function(){
		$('#ubahKategori{{$data_Kategori->kode_kategori_lensa}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deleteKategori{{$data_Kategori->kode_kategori_lensa}}').on('submit',function(){
		$('#hapusKategori{{$data_Kategori->kode_kategori_lensa}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})



</script>
@endforeach

