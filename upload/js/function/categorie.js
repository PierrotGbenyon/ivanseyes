$(document).ready(function(){
	var base_url = $('#base_url').val();

	$('.new_btn').click(function(e){
    $('#new').modal('show');
	});

	$('.new-category').click(function(e){
    e.preventDefault();
		var to_give = $('#new-category').serialize();
		$.ajax({
        type: 'POST',
        url: base_url +'room/categorie/new_categorie',
        data: to_give,
        success: function(data)  {
          code_info(data);
					if(data== 1) redirect('room/categorie') ;
				},
        error: function() {
            code_info(500);
        }
    });
	});

  $('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parents('small').attr('id');
		$('input[name="a-id"]').val(id);
		$('input[name="a-libelle"]').val($(this).parents('div').children('span:first-child').text());
		$('input[name="a-prix"]').val($(this).parents('div').children('span:nth-child(3)').attr('class'));
		$.getJSON(base_url+'room/categorie/info',{id:id},function(data){
			$('.detail-info').html('Catégorie <span class="text-bold text-primary">'+data['libelle']+'</span>.<br/> Créée le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+data['createur']+'</span>.');
		});
    $('#action').modal('show');
	});

  $('.up-s').click(function(e){
		e.preventDefault();
		$('input[name="up-id"]').val($('input[name="a-id"]').val());
		$('input[name="old-libelle"]').val($('input[name="a-libelle"]').val());
		$('input[name="up-libelle"]').val($('input[name="a-libelle"]').val());
    $('#action').modal('hide');
    $('#up').modal('show');
	});

	$('.us-s').click(function(e){
		e.preventDefault();
		$('input[name="us-id"]').val($('input[name="a-id"]').val());
		$('input[name="us-libelle"]').val($('input[name="a-libelle"]').val());
		$('input[name="us-prix"]').val($('input[name="a-prix"]').val());
    $('#action').modal('hide');
    $('#us').modal('show');
	});

  $('.del-s').click(function(e){
		e.preventDefault();
		$('input[name="del-id"]').val($('input[name="a-id"]').val());
    $('input[name="del-libelle"]').val($('input[name="a-libelle"]').val());
		$('.del-lib').text($('input[name="a-libelle"]').val());
    $('#action').modal('hide');
    $('#del').modal('show');
	});

	$('.update').click(function(e){
    var to_give = $('#update').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'room/categorie/update',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('room/categorie');
      },
      error: function(){ code_info(500); }
    });
  });

	$('.usdate').click(function(e){
    var to_give = $('#usdate').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'room/categorie/usdate',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('room/categorie');
      },
      error: function(){ code_info(500); }
    });
  });

  $('.delete').click(function(e){
    var to_give = $('#delete').serialize();
		$.ajax({
      type: 'POST',
      url: base_url+'room/categorie/delete',
      data: to_give,
      success: function(data)  {
				code_info(data);
				if (data == 1) redirect('room/categorie');
      },
      error: function(){ code_info(500); }
    });
  });

	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.error('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Catégorie déja existante', 'Abandon !') ;}
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
