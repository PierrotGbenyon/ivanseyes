$(document).ready(function(){
	var base_url = $('#base_url').val();

	$('.new_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'home'+'">Accueil</a></li><li class=""><a href="'+base_url+'profil'+'">Profil</a></li><li class="active">Nouveau profil</li>';
			$('.list').slideToggle(400);
			$('.profile').slideToggle(400);
			$('ol').html(temp);
	});

	$('.back_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'home'+'">Accueil</a></li><li class="active">Profil</li>';
			$('.list').slideToggle(400);
			$('.profile').slideToggle(400);
			$('ol').html(temp);
	});

	$('.icon').click(function(e){
		if ($(this).parent().children('input').attr('checked') == 'checked') {
			$(this).parent().children('input').removeAttr('checked');
			$(this).parent().removeClass('btn-dprimary').addClass('btn-lprimary');

			if ($(this).parent().children('input').val().split('@')[1] =='C') {
				var temp1 = $(this).parent().children('input').val().split('@')[0]+'@';
				$('[value^= "'+temp1+'"]').each(function(){
					$(this).parent().children('input').removeAttr('checked');
					$(this).parent().removeClass('btn-dprimary').addClass('btn-lprimary');
				});
			}
		}
		else {
			$(this).parent().children('input').attr('checked','checked');
			$(this).parent().removeClass('btn-lprimary').addClass('btn-dprimary');

			if ($(this).parent().children('input').val().split('@')[1] !='C') {
				var temp2 = $(this).parent().children('input').val().split('@')[0]+'@C';
				if ($('[value= "'+temp2+'"]').attr('checked') != 'checked') $('[value= "'+temp2+'"]').parent().children('i').trigger('click');
			}
		}
	});

	$('.new-profile').click(function(e){
		var to_give = $('#new-profile').serialize();
		var right = '';
		$(':checked').each(function(){
			if ($(this).val()!='...') {
				right += $(this).val() +'-';
			}
		});
		$.ajax({
	      type: 'POST',
	      url: base_url +'profil/new_profile',
	      data: to_give,
	      success: function(data)  {
					if(data!= 1) code_info(data);
	        if (data ==1) {
						$.ajax({
			        type: 'POST',
			        url: base_url +'profil/set_right',
			        data: {right:right},
			        success: function(data2)  {
			           code_info(data2);
								 if(data2 == 1) redirect('profil');
			        },
			        error: function() { code_info(500); }
				    });
	      	}
				},
	      error: function() { code_info(500); }
		  });
	});

	$('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parent().attr('id');
		$('input[name="a-id"]').val(id);
		$('input[name="a-name"]').val($(this).parents('div').children('span:first').text());
		$.getJSON(base_url+'profil/info',{id:id},function(data){
			var temp;
			if (data.createur ==' ') {temp = 'le sytème';}else {temp= data['createur'];}
			$('.detail-info').html('Profil <span class="text-bold text-primary">'+data['nom_profil']+'</span>.<br/> Crée le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+temp+'</span>.');
		});
    $('#action').modal('show');
	});

  // $('.up-s').click(function(e){
	// 	e.preventDefault();
	// 	$('input[name="up-id"]').val($('input[name="a-id"]').val());
	// 	$('input[name="old-code"]').val($('input[name="a-code"]').val());
	// 	$('input[name="up-code"]').val($('input[name="a-code"]').val());
  //   $('#action').modal('hide');
  //   $('#up').modal('show');
	// });
	//
  $('.del-s').click(function(e){
		e.preventDefault();
		$('input[name="del-id"]').val($('input[name="a-id"]').val());
    $('input[name="del-name"]').val($('input[name="a-name"]').val());
		$('.del-name').text($('input[name="a-name"]').val());
    $('#action').modal('hide');
    $('#del').modal('show');
	});

	$('.dt-s').click(function(e){
		$('input[name="dt-id"]').val($('input[name="a-id"]').val());
		$('input[name="dt-name"]').val($('input[name="a-name"]').val());
		$('.dt-sub').trigger('click');
	});

	$('.delete').click(function(e){
    var to_give = $('#delete').serialize();
		$.ajax({
        type: 'POST',
        url: base_url+'profil/delete',
        data: to_give,
        success: function(data)  {
					code_info(data);
					if (data == 1) redirect('profil');
        },
        error: function(){ code_info(500);}
    });
  });


	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.info('Données incorrectes.', 'Abandon !') ;}
		if (code == 2) { toastr.error('Nom de profil déja utilisé', 'Abandon !') ;}
    if (code == 1) { toastr.success('Opération réussie.', 'Effectué !') ;}
		if (code == 0) { toastr.info('Remplissez tout le formulaire.', 'Formulaire non valide !') ;}
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
