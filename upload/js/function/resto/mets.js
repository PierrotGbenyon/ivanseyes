$(document).ready(function(){
	var base_url = $('#base_url').val();
  $('.search-select').select2();

  $('.new_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'accueil'+'">Accueil</a></li><li class=""><a href="'+base_url+'resto/mets'+'">Mets</a></li><li class="active">Ajouter un mets</li>';
			$('.list').slideToggle(400);
			$('.dish').slideToggle(400);
			$('ol').html(temp);
	});

	$('.back_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'accueil'+'">Accueil</a></li><li class="active">Mets</li>';
			$('.list').slideToggle(400);
			$('.dish').slideToggle(400);
			$('ol').html(temp);
	});

  $('#lib').change(function(e){
    var temp = $(this).val();
    $('input[name="unit"]').val($('option[value="'+temp+'"]').attr('class'));
  });

  $('.stuff').click(function(e){
    $('#stuff').modal('show');
	});

	$('.new-stuff').click(function(e){
    e.preventDefault();
		var to_give = $('#new-stuff').serialize();
		$.ajax({
        type: 'POST',
        url: base_url +'resto/mets/valid_denree',
        data: to_give,
        success: function(data)  {
					if(data == 0) $('#new-stuff').submit();
					if(data == 1) {
            var d_lib = $('[name="lib"]').val();
            var d_qte = $('[name="qte-u"]').val();
            var d_unit = $('[name="unit"]').val();
            $('<div class="form-group col-md-12"><label for="dlib" class="col-md-2 control-label">Denrée</label><div class="col-md-4"><input type="text" class="form-control input-sm" id="dlib" name="dlib" required readonly value="'+d_lib+'"><div class="form-control-line"></div></div><label for="dqte" class="col-md-1 control-label">Qté</label><div class="col-md-3"><input type="text" class="form-control input-sm" id="dqte" name="dqte" data-rule-number required readonly value="'+d_qte+'"><div class="form-control-line"></div></div><label for="d-unit" class="col-md-1 control-label">Unité</label><div class="col-md-1"><input type="text" class="form-control input-sm" id="d-unit" name="d-unit" readonly value="'+d_unit+'"><div class="form-control-line"></div></div></div>').insertAfter($('.denree'));
            $('[name="lib"]').val(null);
            $('[name="qte-u"]').val(null);
            $('[name="unit"]').val(null);
            $('#stuff').modal('hide');
          }
				},
        error: function() {
            code_info(500);
        }
    });
	});

	$('[name="cat"]').change(function(e){
			if($(this).val() == 'Boisson') $('.qté').slideDown(400);
			else $('.qté').slideUp(400);
	});

	$('.new-mets').click(function(e){
    e.preventDefault();
		var libelle = $('[name="libelle"]').val();var cat = $('[name="cat"]').val();
		var prix = $('[name="prix"]').val();var qte = $('[name="qte"]').val();
		var seuil = $('[name="seuil"]').val();
		var dlib = '';var dqte='';
		$('[name="dlib"]').each(function(){dlib += $(this).val()+'-';});
		$('[name="dqte"]').each(function(){dqte += $(this).val()+'-';});

		$.ajax({
      type: 'POST',
      url: base_url +'resto/mets/new_mets',
      data: {libelle:libelle,cat:cat,prix:prix,qte:qte,seuil:seuil,dlib:dlib,dqte:dqte},
      success: function(data)  {
				code_info(data);
				if(data == 0) $('#new-mets').submit();
				if(data == 1) redirect('resto/mets');
			},
      error: function() {
          code_info(500);
      }
    });
	});

  $('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parents('td').attr('id');
		$('input[name="a-id"]').val(id);
		$('input[name="a-cat"]').val($(this).parents('tr').children('td:nth-child(2)').text());
		$('input[name="a-libelle"]').val($(this).parents('tr').children('td:nth-child(3)').text());
		$('input[name="a-prix"]').val($(this).parents('tr').children('td:nth-child(4)').attr('class'));
		$.getJSON(base_url+'resto/mets/info',{id:id},function(data){
			$('.detail-info').html(data['categorie']+' <span class="text-bold text-primary">'+data['libelle']+'</span>.<br/> Crée le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+data['createur']+'</span>.');
		});
    $('#action').modal('show');
	});

  $('.up-s').click(function(e){
		e.preventDefault();
		$('input[name="up-id"]').val($('input[name="a-id"]').val());
		$('input[name="old-libelle"]').val($('input[name="a-libelle"]').val());
		$('input[name="up-libelle"]').val($('input[name="a-libelle"]').val());
		$('input[name="up-cat"]').val($('input[name="a-cat"]').val());
    $('#action').modal('hide');
    $('#up').modal('show');
	});

	$('.us-s').click(function(e){
		e.preventDefault();
		$('input[name="us-id"]').val($('input[name="a-id"]').val());
		$('input[name="us-clib"]').val($('input[name="a-cat"]').val()+' '+$('input[name="a-libelle"]').val());
		$('input[name="us-libelle"]').val($('input[name="a-libelle"]').val());
		$('input[name="us-prix"]').val($('input[name="a-prix"]').val());
    $('#action').modal('hide');
    $('#us').modal('show');
	});

  $('.del-s').click(function(e){
		e.preventDefault();
		$('input[name="del-id"]').val($('input[name="a-id"]').val());
    $('input[name="del-libelle"]').val($('input[name="a-cat"]').val()+' '+$('input[name="a-libelle"]').val());
		$('.del-lib').text($('input[name="a-cat"]').val()+' '+$('input[name="a-libelle"]').val());
    $('#action').modal('hide');
    $('#del').modal('show');
	});

	$('.update').click(function(e){
    var to_give = $('#update').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'resto/mets/update',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('resto/mets');
      },
      error: function(){ code_info(500); }
    });
  });

	$('.usdate').click(function(e){
    var to_give = $('#usdate').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'resto/mets/usdate',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('resto/mets');
      },
      error: function(){ code_info(500); }
    });
  });

  $('.delete').click(function(e){
    var to_give = $('#delete').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'resto/mets/delete',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('resto/mets');
      },
      error: function(){ code_info(500); }
    });
  });

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.error('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Mets déja existant', 'Abandon !') ;}
    if (code == 1) { toastr.success('Opération réussie.', 'Effectué !') ;}
		if (code == 0) { toastr.error('Remplissez tout le formulaire.', 'Formulaire non valide !') ;}
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
