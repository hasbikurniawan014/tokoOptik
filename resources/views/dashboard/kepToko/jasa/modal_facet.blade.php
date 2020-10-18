<form action="{{route('jasa.store')}}" method="POST" id="storeFacet" type="multipart/form-data">
	@csrf
	<div class="modal fade" tabindex="-1" id="tambahFacet">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Tambah Facet
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Facet</label>
						<input type="text" name="facet" class="form-control" maxlength="25"  required="" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="harga form-control" required="" autocomplete="off" maxlength="10">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-paper-plane mr-2"></i>Simpan Facet Baru</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>


@foreach($facet as $data_facet)
<form action="{{route('jasa.update',$data_facet->kode_facet)}}" method="POST" id="updateFacet{{$data_facet->kode_facet}}" type="multipart/form-data">
	@csrf
	{{method_field('PUT')}}
	<div class="modal fade" tabindex="-1" id="ubahFacet{{$data_facet->kode_facet}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">
						Ubah Facet
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Facet </label>
						<input type="text" name="facet" class="form-control" maxlength="25"  required="" value="{{$data_facet->nama_facet}}" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="harga form-control" required="" autocomplete="off" maxlength="10" value="{{$data_facet->harga}}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block btn-sm" ><i class="fa fa-paper-plane mr-2" ></i>Simpan Perubahan Facet</button>	
					<button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="{{route('jasa.destroy',$data_facet->kode_facet)}}" method="POST" id="deleteFacet{{$data_facet->kode_facet}}" type="multipart/form-data">
	@csrf
	{{method_field('DELETE')}}
	<div class="modal fade" tabindex="-1" id="hapusFacet{{$data_facet->kode_facet}}">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body text-center">
					Apakah Anda yakin ingin menghapus data ini ? <br>
					<span class="text-danger text-center">
						Jika anda menghapus Facet ini maka data yang bersangkutan dengan Facet ini ikut terhapus !
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
	$('#updateFacet{{$data_facet->kode_facet}}').on('submit',function(){
		$('#ubahFacet{{$data_facet->kode_facet}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})

	$('#deleteFacet{{$data_facet->kode_facet}}').on('submit',function(){
		$('#hapusFacet{{$data_facet->kode_facet}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})
</script>
@endforeach

