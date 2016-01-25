$(function(){

	$('[name=gestionnaire]').on('change', function(){

		var contenu = $(this).val();
		console.log(contenu);

		if(contenu == 'youtube') { //Si le contenu du select vaut YouTube

			$('#youtube').css('display', 'block'); //Le formulaire Youtube s'affiche 
			$('form:not(#youtube)').css('display', 'none'); //Tous les autres disparaissent

		} else if (contenu == 'image') { //Si le contenu du select vaut Image

			$('#image').css('display', 'block'); //Le formulaire Images s'affiche 
			$('form:not(#image)').css('display', 'none');   //Tous les autres disparaissent

		} else if (contenu =='news') { //Si le contenu du select vaut news

			$('#news').css('display', 'block'); //Le formulaire News s'affiche 
			$('form:not(#news)').css('display', 'none');   //Tous les autres disparaissent

		} else if (contenu == 'doc') { //Si le contenu du select vaut document 

			$('#document').css('display', 'block'); //Le formulaire Documents s'affiche 
			$('form:not(#document)').css('display', 'none');   //Tous les autres disparaissent

		}
	});


	$('select[name=table]').on('change', function() {

		var switch_type = $(this).val(); 
		console.log(switch_type);

		if(switch_type == "Presse") { //Si le select du type d'article vaut Presse il est inutile de display la valeur privée
			$('.private').css('display', 'none');
		} else if (switch_type == "News") { //En revanche pour un type News il faut que la valeur soit renseignée ou on a une erreur
			$('.private').css('display', 'block');
		}
	});

	$("#news").submit(function(event) {
		if($('select[name=table]').val() == 'Selectionnez'){
				alert('Veuillez sélectionner un type de contenu: news ou article');
				event.preventDefault();
			}
	});
});

