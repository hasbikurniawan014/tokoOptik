<form action="{{route('type.store')}}" method="POST" id="storeType" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahType">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Type
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Type Lensa </label>
						<input type="text" name="type" class="form-control" maxlength="16"  required="" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Type Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($type as $data_Type)
<form action="{{route('type.update',$data_Type->kode_type_lensa)}}" method="POST" id="updateType{{$data_Type->kode_type_lensa}}" enctype="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahtype{{$data_Type->kode_type_lensa}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Type
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Type Lensa </label>
						<input type="text" name="type" class="form-control" maxlength="25"  required="" value="{{$data_Type->type_lensa}}" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Type</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('type.destroy',$data_Type->kode_type_lensa)}}" method="POST" id="deleteType{{$data_Type->kode_type_lensa}}" enctype="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapustype{{$data_Type->kode_type_lensa}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body text-center">
					Apakah Anda yakin ingin menghapus data ini ? <br>
					<span class="text-danger">
						Jika anda menghapus tipe ini maka data yang bersangkutan dengan tipe ini akan ikut terhapus !
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
	$('#updateType{{$data_Type->kode_type_lensa}}').on('submit',function(){
		$('#ubahtype{{$data_Type->kode_type_lensa}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deleteType{{$data_Type->kode_type_lensa}}').on('submit',function(){
		$('#hapustype{{$data_Type->kode_type_lensa}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})


</script>
@endforeach

