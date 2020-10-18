@if(count($errors)>0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissible"   id="alert_message"  role="alert">
			{{$error}}  
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	@endforeach
@endif

@if(session('success'))
	<div class="alert alert-success alert-dismissible"  id="alert_message" role="alert">
		{{session('success')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	 </div>
@endif

@if(session('error'))
	<div class="alert alert-warning alert-dismissible"  id="alert_message"  role="alert">
		{{session('error')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	 </div>
@endif


@if(session('notifikasi'))
	<div class="alert alert-info alert-dismissible"  id="alert_message"  role="alert">
		<i class="fa fa-exclamation-circle">	</i>
		{{session('notifikasi')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	 </div>
@endif