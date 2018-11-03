$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('.search-select').select2();

	$('.new_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'home'+'">Accueil</a></li><li class="">Caisse</li><li class=""><a href="'+base_url+'caisse/operation'+'">Opérations</a></li><li class="active">Nouvelle opération</li>';
			$('.list').slideToggle(400);
			$('.process').slideToggle(400);
			$('ol').html(temp);
	});

	$('.back_btn').click(function(e){
		var temp = '<li class=""><a href="'+ base_url + 'home'+'">Accueil</a></li><li class="">Caisse</li><li class="active">Opérations</li>';
			$('.list').slideToggle(400);
			$('.process').slideToggle(400);
			$('ol').html(temp);
	});

	$('.product').click(function(e){
    $('#new-product').modal('show');
	});

	$('#compte').change(function(e){
		if($(this).val()) $('.badge-produit').slideDown(400);
    else $('.badge-produit').slideUp(400);
	});

	$('#sel-prod').change(function(e){
		var id = $(this).val();
		var id2 = $('[name="compte"]').val();
		$.getJSON(base_url+'caisse/get_price',{prod:id,compte:id2},function(data){
			$('[name="sel-pu"]').val(data['prix_unitaire']);
			$('[name="sel-ps"]').val(data['ps']);
		});
	});

	$('#sel-qte').keyup(function(e){
		var qt = $('[name="sel-qte"]').val();
		$('[name="sel-money"]').val(qt*$('[name="sel-pu"]').val());
		$('[name="sel-ps-tot"]').val(qt*$('[name="sel-ps"]').val());
	});

	$('.new-product').click(function(){
		var to_give = $('#new-product-form').serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'caisse/check_product',
				data: to_give,
				success: function(data)  {
					if (data == 0) $('#new-product-form').submit();
					if (data == 1) {
						var prod = $('[name="sel-prod"]').val();
						var qt = $('[name="sel-qte"]').val();
						var pu = $('[name="sel-pu"]').val();
						var ps = $('[name="sel-ps-tot"]').val();
						var money = $('[name="sel-money"]').val();
						var temp = $('[name="money"]').val();
						$('[name="money"]').val(parseInt(temp,10)+parseInt(money,10));
						$('<div class="form-group col-sm-12 no-padding"><label for="prod" class="col-sm-2 control-label">Produit</label><div class="col-sm-4"><input type="text" class="form-control input-sm" id="prod" name="prod" required readonly value="'+prod+'"><div class="form-control-line"></div></div><label for="pu" class="col-sm-1 control-label">P.U</label><div class="col-sm-2"><input type="text" data-rule-number class="form-control input-sm" id="pu" name="pu" readonly value="'+pu+'"><div class="form-control-line"></div></div><label for="qte" class="col-sm-1 control-label">Qté</label><div class="col-sm-2"><input type="text" data-rule-number class="form-control input-sm" id="qte" name="qte" required readonly value="'+qt+'"><div class="form-control-line"></div><input type="hidden" id="ps" name="ps" value="'+ps+'"></div></div>').appendTo('.badge-produit');
						// $('#new-product-form').reset();
						$('[name="sel-prod"]').val(null);
						$('[name="sel-qte"]').val(null);
						$('[name="sel-pu"]').val(null);
						$('[name="sel-ps"]').val(null);
						$('[name="sel-money"]').val(null);
						$('.close-modal').trigger('click');
					}
				},
				error: function(){
						code_info(500);
				}
		});
	});

	$('.new-process').click(function(e){

		var compte = $('[name="compte"]').val();
		var date_c=$('[name="date_c"]').val();
		var money= $('[name="money"]').val();
		var prod = '';var qte='';var ps='';
		$('[name="prod"]').each(function(){prod += $(this).val()+'-';});
		$('[name="qte"]').each(function(){qte += $(this).val()+'-';});
		$('[name="ps"]').each(function(){ps += $(this).val()+'-';});
		// alert(prod+'++++++++++++'+qte+'++++++++++'+ps);
		$.ajax({
				type: 'POST',
				url: base_url+'caisse/new_process',
				data: {compte:compte,date_c:date_c,money:money,prod:prod,qte:qte,ps:ps},
				success: function(data)  {
					code_info(data);
					if (data == 0) $('#new-process').submit();
					if (data == 1) refresh();
				},
				error: function(){
						code_info(500);
				}
		});
	});

	$('.action').click(function(e){
		e.preventDefault();
		var id = $(this).parents('td').attr('id');
		$('#id').val(id);
		$.getJSON(base_url+'caisse/info_process',{id:id},function(data){
			$('.detail-info').html('Opération <span class="text-bold">'+data['type_operation']+'</span>. Créé le <span class="text-bold">'+data['created']+'</span> par <span class="text-bold">'+data['nom']+'</span>.');
		});
	});

	$('.price').click(function(e){
			e.preventDefault();
			var id = $('input[name="id"]').val();
			$('input[name="id_operation"]').val(id);
			$('.list-prod').trigger('click');
  });


	function code_info(code) {

		intialise_toatsr();
		if (code == 3) { toastr.info('Données incorrectes.', 'Abandon !') ;}
    if (code == 1) { toastr.success('Opération réussie.', 'Effectué !') ;}
		if (code == 0) { toastr.info('Formulaire non valide.', 'Erreur de remplissage !') ;}
		if (code == 500) { toastr.info('Réssayez ou contactez l\'administrateur.', 'Base de données indisponible !') ;}
	}

	function intialise_toatsr() {

		toastr.clear();
	  toastr.options = { "positionClass": "toast-bottom-right", "timeOut":1800};
	}

	function refresh() {
		window.location.href = base_url+'caisse/operation';
	}

})
