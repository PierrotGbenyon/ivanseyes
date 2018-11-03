$(document).ready(function(){
	var base_url = $('#base_url').val();

  $('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parents('small').attr('id');
		var desc = $(this).parents('div').children('span:nth-child(3)').text();
		var del = $(this).parents('div').children('span:nth-child(6)').text();
		$('input[name="a-id"]').val(id);
		$('input[name="a-desc"]').val(desc);
		$('input[name="a-model"]').val($(this).parents('div').children('span:nth-child(7)').text());
		$('input[name="a-idd"]').val($(this).parents('div').children('span:nth-child(8)').text());
		$('.detail-info').html('<span class="text-bold text-primary">'+desc+'</span> supprimé(e) le <span class="text-bold">'+del+'</span>.');
    $('#action').modal('show');
	});

  $('.rt-s').click(function(e){
		e.preventDefault();
		$('input[name="rt-id"]').val($('input[name="a-id"]').val());
		$('input[name="rt-idd"]').val($('input[name="a-idd"]').val());
    $('input[name="rt-desc"]').val($('input[name="a-desc"]').val());
    $('input[name="rt-model"]').val($('input[name="a-model"]').val());
		$('.rt-desc').text($('input[name="a-desc"]').val());
    $('#action').modal('hide');
    $('#rt').modal('show');
	});

	$('.del-s').click(function(e){
		e.preventDefault();
		$('input[name="del-id"]').val($('input[name="a-id"]').val());
		$('input[name="del-idd"]').val($('input[name="a-idd"]').val());
    $('input[name="del-desc"]').val($('input[name="a-desc"]').val());
    $('input[name="del-model"]').val($('input[name="a-model"]').val());
		$('.del-desc').text($('input[name="a-desc"]').val());
    $('#action').modal('hide');
    $('#del').modal('show');
	});

	$('.restore').click(function(e){
    var to_give = $('#restore').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'corbeille/restore',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('corbeille');
      },
      error: function(){ code_info(500); }
    });
  });

  $('.delete').click(function(e){
    var to_give = $('#delete').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'corbeille/delete',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('corbeille');
      },
      error: function(){ code_info(500); }
    });
  });

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.error('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Catégorie déja existente', 'Abandon !') ;}
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
