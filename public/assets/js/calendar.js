$(function(){

	$( "#datepicker" ).datepicker({
		inline: true,
		onSelect: function(e) { // au click on récupère la data sous la forme dd/mm/yyyy
			
			var day = e.substr(0,2); // on récupère le jour dd
			var mounth = e.substr(3,2); // on récupère le mois mm
			var year = e.substr(6,8); // on récupère l'année yyy

			$.ajax({
				url: '/calendar', // appel de la fonction php qui récupère les evenement en BDD
				data: {day: day, mounth: mounth, year: year, }, // php exige 3 parametres récupérer dans la date pour selectionner les bon evenements
			})
			.done(function(data) {
				console.log("success");
				var myData = JSON.parse(data); // on met sous forme de tableau le json envoyé par php
				if(myData.length != 0){ // on vérifié la longueur du tableau pour savoir si il y a des evenements a la date selectionnée
					console.log(myData);
					$('#calendar').remove(); // on supprime l'afficheur
					$('body').append('<div id="calendar"></div>'); // on insert un afficheur
					$('#calendar').append('<div id="calcontent"></div>'); // on ajouter un conteneur pour les evenements 
					$('#calcontent').append('<h3>Evenement du '+e+'</h3>'); // on ajoute le titre 
					$(myData).each(function(i) { // on récupère le ou les evenement du data
						$('#calcontent').append('<div class="evenement"></div>'); // un conteneur par evenement
						$('.evenement').append('<p>'+myData[i]['heure']+'</p>'); // l'heure 
						$('.evenement').append('<p>'+myData[i]['description']+'</p>'); // la description
					});
				}

				$('#calendar').on('click', function(){
					$('#calendar').remove(); // on supprime l'afficheur
				});
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
			
		}
	});


	$( "#dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);

});