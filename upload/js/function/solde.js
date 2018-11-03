$(document).ready(function(){
	var base_url = $('#base_url').val();
  // $('.search-select').select2();

  $('.new_btn').click(function(e){
    $('#new').modal('show');
	});

	$('input[name="choix"]').click(function(e){
    if($(this).attr('checked')=='checked') {
			$('input[name="mt"]').val($('input[name="choix"]').val());
		}
	});

	$('.new-box').click(function(e){
    e.preventDefault();
		var to_give = $('#new-box').serialize();
		$.ajax({
        type: 'POST',
        url: base_url +'caisse/open',
        data: to_give,
        success: function(data)  {
          code_info(data);
					if(data== 1) redirect('caisse') ;
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
		$('input[name="a-date"]').val($(this).parents('tr').children('td:nth-child(1)').text());
		$.getJSON(base_url+'caisse/info',{id:id},function(data){
			$('.detail-info').html('Caisse du <span class="text-bold text-primary">'+data['date_caisse']+'</span>.<br/> Créée le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+data['createur']+'</span>.');
		});
    $('#action').modal('show');
	});

	// $('.info').click(function(e){
	//   var id = $(this).parent().attr('id');
	//   $('input[name="id_chest"]').val(id);
	//   $('.sel-chest').trigger('click');
	// });

  $('.up-s').click(function(e){
		e.preventDefault();
		$('input[name="up-id"]').val($('input[name="a-id"]').val());
		$('input[name="old-code"]').val($('input[name="a-code"]').val());
		$('input[name="up-code"]').val($('input[name="a-code"]').val());
    $('#action').modal('hide');
    $('#up').modal('show');
	});

  $('.del-s').click(function(e){
		e.preventDefault();
		$('input[name="del-id"]').val($('input[name="a-id"]').val());
    $('input[name="del-code"]').val($('input[name="a-code"]').val());
		$('.del-lib').text($('input[name="a-code"]').val());
    $('#action').modal('hide');
    $('#del').modal('show');
	});

	$('.update').click(function(e){
    var to_give = $('#update').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'caisse/update',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('caisse');
      },
      error: function(){ code_info(500); }
    });
  });

  $('.delete').click(function(e){
    var to_give = $('#delete').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'caisse/delete',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('caisse');
      },
      error: function(){ code_info(500); }
    });
  });

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.error('Données incorrectes.', 'Abandon !') ;}
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
