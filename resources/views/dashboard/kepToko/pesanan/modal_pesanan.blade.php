@foreach($data_pesanan->table_item_pesanan as $item)
<div class="modal fade" id="editItem{{$item->kode_produk}}">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Ubah Data Item 
				</h5>
			</div>
			<form action="{{route('pesanan.ubahItem',$item->kode_produk)}}" method="POST" id="ubahItem{{$item->kode_produk}}">
				@csrf
				{{method_field('PUT')}}
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Produk</label>
						<input type="text" name="kode_produk" required="" maxlength="15" autocomplete="off" class="form-control " value="{{$item->kode_produk}}">
					</div>
					<div class="form-group">
						<label for="">Pesanan</label>
						<input type="text" name="pesanan" required="" maxlength="55" autocomplete="off" class="form-control " value="{{$item->pesanan}}">
					</div>
					<div class="form-group">
						<label for="">Jumlah</label>
						<input type="text" name="jumlah" required="" autocomplete="off" class="form-control jumlah" value="{{$item->jumlah}}">
					</div>
					<div class="form-group">
						<label for="">harga</label>
						<input type="text" name="harga" required="" maxlength="55" autocomplete="off" class="form-control  harga" value="{{$item->harga/$item->jumlah}}">
					</div>
					<div class="form-group">
						<label for="">Keterangan</label>
						<input type="text" name="keterangan" autocomplete="off" class="form-control" placeholder="Boleh kosong" value="{{$item->keterangan}}">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning" type="submit">Ubah DataItem</button>
					<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- Hapus item --}}
<div class="modal fade" id="hapusItem{{$item->kode_produk}}">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="{{route('pesanan.hapusItem',$item->kode_produk)}}" method="POST" id="hapusItem">
				@csrf
				{{method_field('DELETE')}}
				<div class="modal-body">
					<div class="text-center">
						Apakah anda yakin ingin menghapus data ini ?
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="submit">Hapus</button>
					<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>




<script>
$(document).ready(function(){
	$('.harga').mask("#.##0.000", {reverse: true})
	$('#ubahItem{{$item->kode_produk}}').on('submit',function(){
		$('#editItem{{$item->kode_produk}}').modal('hide');
		$('#modalProsesUbah').modal('show');
	})
	$('#hapusItem{{$item->kode_produk}}').on('submit',function(){
		$('#hapusItem{{$item->kode_produk}}').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
	$('#batalPesanan').on('submit',function(){
		$('#batal').modal('hide');
		$('#modalProsesHapus').modal('show');
	})
})
</script>


@endforeach

{{-- batal pesanan --}}
<div class="modal fade" id="batal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="{{route('pesanan.destroy',$data_pesanan->kode_pesanan)}}" method="POST" id="batalPesanan">
				@csrf
				{{method_field('DELETE')}}
				<div class="modal-body">
					<div class="text-center">
						Apakah anda yakin ingin membatalkan  pesanan ini ?
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="submit"><i class="fa fa-times mr-2"></i>Ya</button>
					<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

