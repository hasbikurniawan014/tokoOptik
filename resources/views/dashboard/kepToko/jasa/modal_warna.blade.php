<form action="{{route('warna.store')}}" method="POST" id="storePewarnaan" type="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahPewarnaan">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Pewarnaan
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Pewarnaan</label>
						<input type="text" name="warna" class="form-control" maxlength="25"  required="" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="harga form-control" required="" autocomplete="off" maxlength="10">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Pewarnaan Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($pewarnaan as $data_pewarnaan)
<form action="{{route('warna.update',$data_pewarnaan->kode_warna)}}" method="POST" id="updatePewarnaan{{$data_pewarnaan->kode_warna}}" type="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahPewarnaan{{$data_pewarnaan->kode_warna}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Pewarnaan
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Pewarnaan </label>
						<input type="text" name="warna" class="form-control" maxlength="25"  required="" value="{{$data_pewarnaan->warna}}" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="harga form-control" required="" autocomplete="off" maxlength="10" value="{{$data_pewarnaan->harga_warna}}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Pewarnaan</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('warna.destroy',$data_pewarnaan->kode_warna)}}" method="POST" id="deletePewarnaan{{$data_pewarnaan->kode_warna}}" type="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusPewarnaan{{$data_pewarnaan->kode_warna}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body text-center">
					Apakah Anda yakin ingin menghapus data ini ? <br>
					<span class="text-danger text-center">
						Jika anda menghapus Pewarnaan ini maka data yang bersangkutan dengan Pewarnaan ini ikut terhapus !
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
	$('#updatePewarnaan{{$data_pewarnaan->kode_warna}}').on('submit',function(){
		$('#ubahPewarnaan{{$data_pewarnaan->kode_warna}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deletePewarnaan{{$data_pewarnaan->kode_warna}}').on('submit',function(){
		$('#hapusPewarnaan{{$data_pewarnaan->kode_warna}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})

</script>
@endforeach

