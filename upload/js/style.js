$(document).ready(function(){
	var base_url = $('#base_url').val();

	//To add required signe (Orange asterisk)
  var form_label = $('label');
  form_label.each(function(i){
		var ref = $(this).attr('for');
		if ($('#'+ref).attr('required') == 'required') $(this).html($(this).text() + '<span class="red"> *</span>');
  });

  //To lock system
	$('._lock').click(function(e){
		var lien = $('#main-menu a[class="active"]').attr('href');
		$.ajax({
	        type: 'POST',
	        url: base_url+'verou/lock',
	        data: {lien:lien},
	        success: function(data)  {
	        	if(data) redirect('verou');
	        },
	        error: function(){
	            code_info(500);
	        }
	    });
	});

	// to close modal
	$('.close-modal').click(function(e){
		var temp = $(this).parent().children('button').attr('class');
		temp = temp.split(' ');
		$('#'+temp[0]).modal('hide');
	});


	function code_info(code) {
		toastr.clear();
	    toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":false};
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function redirect(lien) {
		window.location.href = base_url+lien;
	}


});
