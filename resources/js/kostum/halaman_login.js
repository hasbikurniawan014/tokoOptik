$(document).ready(function(){

	$(document).on('submit','#login_form',function(event){
		event.preventDefault();
		var username=$('#username').val();
		var password=$('#password').val();

		if (username=='' || password=='') 
		{
				$('#resLogin').show().attr('class','alert-warning alert');
				$('#resIcon').attr('class','fa fa-times mr-2')
				$('.textRes').text('Terdapat Kolom kosong. mohon periksa kembali')
				
				$('#resLogin').click(function(){
					$(this).fadeOut();
				})
			return false;
		}else{
			$('#resLogin').show().attr('class','alert-info alert');
			$('#resIcon').attr('class','fa fa-spinner fa-spin mr-2')
			$('.textRes').text('Proses Login ....')
			var link = $('#login_form').attr('action')
			var data=$(this).serialize();

			$.ajax({
				 headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url:link,
				data:data,
				method:'POST',
				success:function(){
					$('#resLogin').show().attr('class','alert-success alert');
					$('#resIcon').attr('class','fa fa-check animated rubberBand mr-2')
					$('.textRes').text('Berhasil ! selamat Datang !');
					window.location="/home";
				},
				error:function(){
					$('#resLogin').show().attr('class','alert-danger alert');
					$('#resIcon').attr('class','fa fa-times animated rubberBand mr-2')
					$('.textRes').text('Gagal ! username/password tidak di temukan');
				}
			});
		}
	})
})