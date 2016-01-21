$(function(){

	
	function hasEvent(){
		$.ajax({
		  	url: '/event',
		  	data: {},
		  })
		  .done(function(data) {
		  	var myData = JSON.parse(data);

		  	$(myData).each(function(i){
		  		var month = parseInt(myData[i].mounth)-1;
		  		var day = myData[i].day;
		  		if(day.substr(0, 1) == '0'){
		  			var day = day.substr(1, 1);
		  		}
		  		$('[data-day='+day+'][data-month='+month+'][data-year='+myData[i].year+']>a').css('background', '#FF5E5E');
		  	});

		  	$('[data-handler=prev]').on('click', function(){
				hasEvent();
			});

			$('[data-handler=next]').on('click', function(){
				hasEvent();
			});

		  })
		  .fail(function() {
		  })
		  .always(function() {
		  });
	};

	hasEvent();


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
				var myData = JSON.parse(data); // on met sous forme de tableau le json envoyé par php
				if(myData.length != 0){ // on vérifié la longueur du tableau pour savoir si il y a des evenements a la date selectionnée
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

				hasEvent();
			})
			.fail(function() {
			})
			.always(function() {
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