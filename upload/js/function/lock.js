$(document).ready(function(){
	var base_url = $('#base_url').val();

	$('._ulock').click(function(e){
		e.preventDefault();
		var to_give = $('#_ulock').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'verou/unlock',
        data: to_give,
        dataType: 'JSON',
        success: function(data)  {
					if ((data.out == 0) || (data.out == 3)) code_info(data.out);
					else redirect(data.out);
        },
        error: function(){
            code_info(500);
        }
    });
	});

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.error('Mot de passe incorrect.', 'Erreur !') ;}
		if (code == 0) { toastr.info('Remplissez tout le formulaire.', 'Erreur !') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":true};
	}

	function redirect(lien) {

		window.location.href = lien;
	}

})
