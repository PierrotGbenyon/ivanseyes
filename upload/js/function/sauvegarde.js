$(document).ready(function(){
	var base_url = $('#base_url').val();
  $('.search-select').select2();

  $('.new_btn').click(function(e){
    e.preventDefault();
		$.ajax({
        type: 'POST',
        url: base_url +'sauvegarde/new_sauvegarde',
        success: function(data)  {
          code_info(data);
					if(data== 1) redirect('sauvegarde') ;
				},
        error: function() { code_info(500); }
    });
	});


	function code_info(code) {

		intialise_toatsr();
		if (code == 2) { toastr.error('Sauvegarde déja existente', 'Abandon !') ;}
    if (code == 1) { toastr.success('Sauvegarde réussie.', 'Effectué !') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":true};
	}

	function redirect(lien) {

		setTimeout(function(){
			window.location.href = base_url +lien;
		},2010);
	}

})
