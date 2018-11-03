$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('.search-select').select2();

	$('.new_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'accueil'+'">Accueil</a></li><li class=""><a href="'+base_url+'utilisateur'+'">Compte utilisateur</a></li><li class="active">Créer un compte</li>';
			$('.list').slideToggle(400);
			$('.user').slideToggle(400);
			$('ol').html(temp);
	});

	$('.back_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'accueil'+'">Accueil</a></li><li class="active">Compte utilisateur</li>';
			$('.list').slideToggle(400);
			$('.user').slideToggle(400);
			$('ol').html(temp);
	});

	$('.new-user').click(function(e){
		e.preventDefault();
    var to_give = $('#new-user').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'utilisateur/nvo_user',
        data: to_give,
        dataType: 'JSON',
        success: function(data)  {
          code_info(data.out);
					if (data.out == 0) $('#new-user').submit();
					if (data.out == 1) redirect('utilisateur');
        },
        error: function(){
            code_info(500);
        }
    });
  });

	$('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parents('td').attr('id');
		$('input[name="a-id"]').val(id);
		$('input[name="etat"]').val($(this).parents('td').prev().text());
		$('input[name="a-login"]').val($(this).parents('tr').children('td:nth-child(2)').text());
		$.getJSON(base_url+'utilisateur/info',{id:id},function(data){
			var temp;
			if (data.createur ==' ') {temp = 'le sytème';}else {temp= data['createur'];}
			$('.detail-info').html('Compte <span class="text-bold text-primary">'+data['login']+'</span> pour <span class="text-bold text-primary">'+data['nom']+'</span>.<br/> Créé le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+temp+'</span>.');
		});

		if($('input[name="etat"]').val() == 'actif') $('.activate-text').html('Désactiver le compte');
		else { $('.activate-text').html('Activer le compte'); }
		$('#action').modal('show');

	});

	$('.activate').click(function(e){
    var to_give = $('#action-form').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'utilisateur/cg_etat',
        data: to_give,
        success: function(data)  {
          code_info(data);
					if (data == 1) redirect('utilisateur');
        },
        error: function(){
            code_info(500);
        }
    });
  });

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.info('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Nom d\'utilisateur déja utilisé', 'Abandon !') ;}
		if (code == 1) { toastr.success('Opération réussie.', 'Effectué !') ;}
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
