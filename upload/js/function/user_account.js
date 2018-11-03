$(document).ready(function(){
	var base_url = $('#base_url').val();

	$('.up-password').click(function(e){
		var to_give = $('#password-form').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'utilisateur/change_password',
        data: to_give,
        success: function(data)  {
          code_info(data);
          $('#password-form').reset();
        },
        error: function(){
            code_info(500);
        }
    });
	});

	function code_info(code) {

		intialise_toatsr();
		if (code == 5) { toastr.error('Ancien mot de passe incorrect', 'Erreur !') ;}
		if (code == 3) { toastr.info('Données incorrectes.', 'Abandon !') ;}
		if (code == 1) { toastr.success('Mot de passe modifié', 'Effectué !') ;}
		if (code == 0) { toastr.info('Remplissez tout le formulaire.', 'Formulaire non valide !') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":true};
	}

	function redirect(lien) {
		window.location.href = base_url+lien;
	}

})
