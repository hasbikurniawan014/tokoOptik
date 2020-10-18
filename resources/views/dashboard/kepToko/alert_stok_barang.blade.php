
<button class="btn alert btn-block alert-primary  rounded" data-toggle="modal" data-target="#stokBarang"> 
	<ht class=""><i class="fa fa-exclamation-circle mr-2 "></i> Terdapat Stok < 1 Lusin</ht>
</button>
<div class="modal fade" tabindex="-1" id="stokBarang">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header  alert-primary">
				<h5 class="modal-title">
					<i class="fa fa-cubes mr-2"></i>
					Stok barang kurang dari 1 Lusin
				</h5>
			</div>
			<div class="modal-body ">
				@foreach($frame->where('stok','<',10) as $frame )
					<div class="m-2 p-2">
						<div class="row">
							<div class="col-sm">
								<i class="fa fa-tag mr-2 text-primary"></i>{{$frame->kode_produk}}	
							</div>
							<div class="col-sm">
								<small><i class="fa fa-cube mr-2 text-primary"></i>{{$frame->merk}}	</small>
							</div>
							<div class="col-sm">
								{{$frame->stok}} Item
							</div>
							<form action="{{route('stok.frame')}}" method="POST" class="formTambahStok">
								@csrf {{method_field('PUT')}}
								<div class="col-sm">
									<div class="input-group">
										<input type="text" name="kode_produk" value="{{$frame->kode_produk}}" hidden="">
										<input type="text" name="tambahStok" placeholder="Jumlah" class="form-control stok" data-toggle="tooltip" data-placement="top" title="Satuan Lusin">
										<span class="input-group-prepend">
											<button class="btn btn-outline-primary	ing btn-sm">Tambah Stok</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endforeach			
				@foreach($typeBf->where('stok','<',10) as $bf )
					<div class="m-2 p-2">
						<div class="row">
							<div class="col-sm">
								<i class="fa fa-tag mr-2 text-primary"></i>{{$bf->fg_kode_produk_bf}}	
							</div>
							<div class="col-sm">
								<small><i class="fa fa-cube mr-2 text-primary"></i>{{$bf->table_lensa_bf->merk}}	</small>
							</div>
							<div class="col-sm">
								{{$bf->stok}} Item
							</div>
							<form action="{{route('stok.bf')}}" method="POST" class="formTambahStok">
								@csrf {{method_field('PUT')}}
								<div class="col-sm">
									<div class="input-group">
										<input type="text" name="kode_produk" value="{{$bf->fg_kode_produk_bf}}" hidden="">
										<input type="text" name="tambahStok" placeholder="Jumlah" class="form-control stok" data-toggle="tooltip" data-placement="top" title="Satuan Lusin">
										<span class="input-group-prepend">
											<button class="btn btn-outline-primary	ing btn-sm">Tambah Stok</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endforeach
				@foreach($typeSv->where('stok','<',10) as $bf )
					<div class="m-2 p-2">
						<div class="row">
							<div class="col-sm">
								<i class="fa fa-tag mr-2 text-primary"></i>{{$bf->fg_kode_produk_sv}}	
							</div>
							<div class="col-sm">
								<small><i class="fa fa-cube mr-2 text-primary"></i>{{$bf->table_lensa_Sv->merk}}	</small>
							</div>
							<div class="col-sm">
								{{$bf->stok}} Item
							</div>
							<form action="{{route('stok.sv')}}" method="POST" class="formTambahStok">
								@csrf {{method_field('PUT')}}
								<div class="col-sm">
									<div class="input-group">
										<input type="text" name="kode_produk" value="{{$bf->fg_kode_produk_sv}}" hidden="">
										<input type="text" name="tambahStok" placeholder="Jumlah" class="form-control stok" data-toggle="tooltip" data-placement="top" title="Satuan Lusin">
										<span class="input-group-prepend">
											<button class="btn btn-outline-primary	ing btn-sm">Tambah Stok</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endforeach
				@foreach($soft->where('stok','<',10) as $bf )
					<div class="m-2 p-2">
						<div class="row">
							<div class="col-sm">
								<i class="fa fa-tag mr-2 text-primary"></i>{{$bf->kode_produk}}	
							</div>
							<div class="col-sm">
								<small><i class="fa fa-cube mr-2 text-primary"></i>{{$bf->merk}}	</small>
							</div>
							<div class="col-sm">
								{{$bf->stok}} Item
							</div>
							<form action="{{route('stok.softlen')}}" method="POST" class="formTambahStok">
								@csrf {{method_field('PUT')}}
								<div class="col-sm">
									<div class="input-group">
										<input type="text" name="kode_produk" value="{{$bf->kode_produk}}" hidden="">
										<input type="text" name="tambahStok" placeholder="Jumlah" class="form-control stok" data-toggle="tooltip" data-placement="top" title="Satuan Lusin">
										<span class="input-group-prepend">
											<button class="btn btn-outline-primary	ing btn-sm">Tambah Stok</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endforeach
				@foreach($cleaner->where('stok','<',10) as $bf )
					<div class="m-2 p-2">
						<div class="row">
							<div class="col-sm">
								<i class="fa fa-tag mr-2 text-primary"></i>{{$bf->kode_produk}}	
							</div>
							<div class="col-sm">
								<small><i class="fa fa-cube mr-2 text-primary"></i>{{$bf->merk}}	</small>
							</div>
							<div class="col-sm">
								{{$bf->stok}} Item
							</div>
							<form action="{{route('stok.pembersih')}}" method="POST" class="formTambahStok">
								@csrf {{method_field('PUT')}}
								<div class="col-sm">
									<div class="input-group">
										<input type="text" name="kode_produk" value="{{$bf->kode_produk}}" hidden="">
										<input type="text" name="tambahStok" placeholder="Jumlah" class="form-control stok" data-toggle="tooltip" data-placement="top" title="Satuan Lusin">
										<span class="input-group-prepend">
											<button class="btn btn-outline-primary	ing btn-sm">Tambah Stok</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endforeach
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary " data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>