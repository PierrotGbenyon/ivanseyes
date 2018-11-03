$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('.search-select').select2();

	$('.bootstrap-tagsinput input').keypress(function(e){
		if(e.keyCode == 13) {
			contain = $(this).val();
			type = $(this).parent().parent().children('input').attr('name');
			$.post(base_url+'parametre/new_element',{value:contain,typ:type},
				function(data)  {
					if (data.out == 0) {intialise_toatsr(); toastr.info('Données incorrectes.', 'Réessayez !') ;}
        }
			);
		};
  });

	$('[data-role="remove"]').click(function(e){
			contain = $(this).parent().text();
			type = $(this).parent().parent().parent().children('input').attr('name');
			$.post(base_url+'parametre/delete_element',{value:contain,typ:type},
				function(data)  {
					if (data.out == 0) {intialise_toatsr(); toastr.info('Données incorrectes.', 'Réessayez !') ;}
        }
			);
	});

	$('#sauvegarde').change(function(e){
		var val = $(this).val();
		$.post(base_url+'parametre/sauvegarde',{value:val},
			function(data)  {
				if (data.out == 0) {intialise_toatsr(); toastr.info('Données incorrectes.', 'Réessayez !') ;}
			}
		);
	});

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.info('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Code déja utilisé.', 'Doublon !') ;}
    if (code == 1) { toastr.success('Opération réussie.', 'Effectué !') ;}
		if (code == 0) { toastr.info('Formulaire non valide.', 'Erreur de remplissage !') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":1800};
	}

	function refresh() {
		window.location.href = base_url+'parametre';
	}

})
