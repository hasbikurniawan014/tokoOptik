@extends('layouts.app')
@section('content')
<h5><i class="fa fa-users mr-2"></i>Jasa Facet & Pewarnaan Lensa</h5>
<hr>
@include('dashboard.kepToko.jasa.modal_facet')
@include('dashboard.kepToko.jasa.modal_warna')
<div class="row">
	<div class="col-sm">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahFacet"><i class="fa fa-plus mr-2"></i>Tambah Jasa Facet</button><hr>		
		{{$facet->links()}}
		<div class="table-responsive">
			<table class="table table-sm table-striped table-bordered table-hover">
				<tr>
					<th class="text-center">No</th>
					<th>Kode Jasa</th>
					<th>Nama</th>
					<th>Harga</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($facet as $data_facet)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td>{{$data_facet->kode_facet}}</td>
					<td>{{$data_facet->nama_facet}}</td>
					<td class="harga">{{$data_facet->harga}}</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#ubahFacet{{$data_facet->kode_facet}}" 
								class="btn btn-outline-primary btn-sm">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#hapusFacet{{$data_facet->kode_facet}}" 
								class="btn btn-outline-danger btn-sm">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>		
	</div>
	<div class="col-sm">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPewarnaan"><i class="fa fa-plus mr-2"></i>Tambah Pewarnaan</button><hr>		
		{{$pewarnaan->links()}}
		<div class="table-responsive">
			<table class="table table-sm table-striped table-bordered table-hover">
				<tr>
					<th class="text-center">No</th>
					<th>Kode Pewarnaan</th>
					<th>Pewarnaan</th>
					<th>harga</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($pewarnaan as $data_pewarnaan)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td>{{$data_pewarnaan->kode_warna}}</td>
					<td>{{$data_pewarnaan->warna}}</td>
					<td class="harga">{{$data_pewarnaan->harga_warna}}</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#ubahPewarnaan{{$data_pewarnaan->kode_warna}}" 
								class="btn btn-outline-primary btn-sm">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
					<td class="text-center">
						<button data-toggle="modal" data-target="#hapusPewarnaan{{$data_pewarnaan->kode_warna}}" 
								class="btn btn-outline-danger btn-sm">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>		
	</div>
</div>

<script>
$(document).ready(function(){
	$('.tanggal').mask('00/00/0000');
	$('.stok').mask('00');
	$('.harga').mask("#.##0.000", {reverse: true})

	$('#storeFacet').on('submit',function(){
		$('#tambahFacet').modal('hide');
		$('#modalProsesTambah').modal('show');
	})
	$('#storePewarnaan').on('submit',function(){
		$('#tambahPewarnaan').modal('hide');
		$('#modalProsesTambah').modal('show');
	})
})
</script>
@endsection