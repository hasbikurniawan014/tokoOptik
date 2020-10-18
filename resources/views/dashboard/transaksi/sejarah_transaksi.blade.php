@extends('layouts.app')
@section('content')
<h5><i class="fa fa-clock mr-2"></i>Sejarah Transaksi</h5>
<hr>
<div class="row">
	<div class="col-sm">
	@if(@$pencarian)
		Hasil pencarian dari : {{$pencarian}} <br> <a href="{{route('transaksi.sejarah')}}" class="text-info" id="resetDataTransaksi"> Reset Pencarian</a>
	@endif
	</div>
	<div class="col-sm">
		<form action="{{route('transaksi.pencarian')}}" method="GET" id="cariTransaksi">
			<div class="input-group">
				<input type="text" name="pencarian" class="form-control" autocomplete="off" required="" placeholder="Cari berdasarkan kode transaksi">
				<span class="input-group-prepend">
					<button class="btn btn-primary btn-sm" type="submit">Cari</button>
				</span>
			</div>
		</form>
	</div>
</div>
<hr>
{{$transaksi->links()}}
<div class="table-responsive">
	<table class="table table-sm table-striped table-bordered table-hover">
		<tr>
			<th class="text-center">No</th>
			<th>kode transaksi</th>
			<th>tgl.transaksi</th>
			<th>Status</th>
			<th></th>
		</tr>
		@foreach($transaksi as $data_Transaksi)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$data_Transaksi->kode_penjualan}}</td>
			<td>{{$data_Transaksi->created_at->format('d F Y')}}</td>
			<td>
				@if($data_Transaksi->status_pembelian ==1 )
				Dalam proses
				@else
				sukses
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('transaksi.index',$data_Transaksi->kode_penjualan)}}" class="btn btn-outline-primary btn-sm">
					<i class="fa fa-eye mr-2"></i> Detail Transaksi
				</a>
				<button data-toggle="modal" data-target="#hapusTransaksi{{$data_Transaksi->kode_penjualan}}" 
						class="btn btn-outline-danger btn-sm">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		<div class="modal fade" tabindex="-1" id="hapusTransaksi{{$data_Transaksi->kode_penjualan}}">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						Apakah anda yakin ingin menghapus data transaksi ini ?
					</div>
					<div class="modal-footer">
						<form action="{{route('transaksi.hapus',$data_Transaksi->kode_penjualan)}}" method="POST" id="formHapusTransaksi">
							@csrf
							{{method_field('DELETE')}}
							<button class="btn btn-danger " type="submit">Ya</button>
							<button class="btn btn-secondary " data-dismiss="modal" >Batal</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>
			$('#formHapusTransaksi').on('submit',function(){
				$('#hapusTransaksi{{$data_Transaksi->kode_penjualan}}').modal('hide');
				$('#modalProsesHapus').modal('show');
			})
		</script>
		@endforeach
	</table>
</div>
<script>
	$(document).ready(function(){
			$('#cariTransaksi').on('submit',function(){
				$('#modalProsesPencarian').modal('show');
			})
			
			$('#resetDataTransaksi').click(function(){
				$('#modalProsesReset').modal('show');
			})
			$('.stok_barang').blur(function(){
				var stok=parseInt($(this).val());
				var item=stok*12;
				$('.item').val(item);

			})
		})
</script>
@endsection