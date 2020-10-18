		<div class="modal fade" tabindex="-1" id="hapusItem{{$item->kode_barang_terjual}}">
			<div class="modal-dialog modal-dialog-centered " role="document">
				<form action="{{route('transaksi.hapus_item',$item->kode_barang_terjual)}}" method="POST" id="deleteitem{{$item->kode_barang_terjual}}">
				@csrf{{method_field('DELETE')}}
					<div class="modal-content">
						<div class="modal-body">
							Apakah anda yakin ingin menghapus item ini?
							<hr>
							<div class="text-center"><b>{{$item->nama_barang}}</b></div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-outline-danger btn-block" type="submit">Hapus Item</button>
							<button class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script>
		$(document).ready(function(){
			$('#deleteitem{{$item->kode_barang_terjual}}').on('submit',function(){
				$('#hapusItem{{$item->kode_barang_terjual}}').modal('hide')	
				$('#modalProsesHapus').modal('show')	
			})
		})
		</script>