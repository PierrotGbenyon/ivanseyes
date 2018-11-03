$(document).ready(function(){
	var back_url = $('#back_url').val();

	//To create new items
	$('._save').click(function(e){
		e.preventDefault();
		
		$.ajax({
	        type: 'POST',
	        url: back_url +'backup/physical_save',

	        success: function(data)  {
	        	code_info(data);
	        },
	        error: function(){
	            code_info(500);
	        }
	    });
	   
	});

	//To delete item
	$('.supp').click(function(e){
		var id = $(this).parents('td').attr('id');
		$.ajax({
	        type: 'POST',
	        url: back_url +'poste/get',
	        data: {id:id},
	        dataType: 'json',

	        success: function(data)  {
	        	$('.sup_id').val(id);
	        	$('#supp ._titre').html('Voullez-vous vraiment supprimer le poste <strong class="text-danger">'+ data['poste']['NomPoste'] + '</strong> <span class ="text-xxl">?</span>');
	        },
	        error: function(){
	            code_info(500);
	        }
	    });

	});


	//To delete item
	$('.supp_conf').click(function(e){
		var id = $('.sup_id').val();
		$.ajax({
	        type: 'POST',
	        url: back_url +'poste/del',
	        data: {id:id},

	        success: function(data)  {
	        	intialise_toatsr();
	        	toastr.info('Le poste a été supprimé avec succès.', 'Suppression réussie!');
	        	refresh();
	        },
	        error: function(){
	            intialise_toatsr();
	        	toastr.error('Le poste n\'a été supprimé. Patienter et réssayer ou contacter l\'administrateur.', 'Suppression échouée !');
	        }
	    });

	});

	function code_info(code)
	{	
		intialise_toatsr();

		if (code == 1) { toastr.info('Nouvelle sauvegarde réalisée.', 'Sauvegarde éffectuée !') ;}
		if (code == 0) { toastr.error('Sauvegarde non réalisée', 'Sauvegarde abandonnée !') ;}
		if (code == 500) { toastr.error('Base de données indisponible. Patienter et réssayer ou contacter l\'administrateur.', 'Erreur !') ;}
	}

	function intialise_toatsr()
	{
		toastr.clear();
	    toastr.options = { "positionClass": "toast-bottom-right", "timeOut":2000,"progressBar":true};
	}

	function refresh()
	{
		setTimeout(function(){
			window.location.href = back_url +'backup';
		},1510);
	}

})