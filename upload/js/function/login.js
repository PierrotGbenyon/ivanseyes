$(document).ready(function(){
	var base_url = $('#base_url').val();

	$('._login').click(function(e){
		e.preventDefault();
		var to_give = $('#_login').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'connexion/connect',
        data: to_give,
				dataType: 'JSON',
        success: function(data)  {
					// $('#csrf').val(data.hash);
					code_info(data.out);
        	if(data.out ==1) redirect('accueil');
        	if(data.out ==5) redirect('utilisateur/mon_compte');
        	if(data.out ==6) redirect('_403');
        },
        error: function(){
            code_info(500);
        }
    });
	});

	function code_info(code) {

		intialise_toatsr();

		if (code == 0) { toastr.info('Remplissez formulaire.', 'Erreur !') ;}
		if (code == 1) { toastr.success('Connexion réussie.', 'Effectué !') ;}
		if (code == 2) { toastr.error('Nom d\'utilisateur incorrect.', 'Erreur login !') ;}
		if (code == 3) { toastr.error('Mot de passe incorrect.', 'Erreur !') ;}
		if (code == 4) { toastr.error('Vous ne pouvez pas vous connecter.', 'Compte désactivé!') ;}
		if (code == 5) { toastr.info('Veuillez s\'il vous plaît changer votre mot de passe.', 'Bienvenu') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":true};
	}

	function redirect(lien) {

		setTimeout(function(){
			window.location.href = base_url +lien;
		},2020);
	}

})
