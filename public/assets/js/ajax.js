$(function(){

	/*VIDEOS*/

	$('.videos').on('click', function(){
		var url = $(this).attr('href');
		var embed = $(this).attr('data-embed');
		var description = $(this).attr('data-description');
		
		$('#player').empty(); /*On video la fenetre du lecteur*/
		/*On ajoute la nouvelle video dans la fenetre du lecteur*/
		$('#player').append('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1024" height="616" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">'+
								'<param name="allowFullScreen" value="true" />'+
								'<param name="allowscriptaccess" value="always" />'+
								'<param name="src" value="'+url+'&amp;hl=fr_FR&amp;fs=1"/>'+
								'<param name="allowfullscreen" value="true" />'+
								'<embed type="application/x-shockwave-flash" width="1024" height="616" src="'+embed+'&amp;hl=fr_FR&amp;fs=1" allowscriptaccess="always" allowfullscreen="true"></embed>'+
							'</object>');
		$('#player').append('<p>'+description+'</p>') /*On ajoute la description de la video*/

		$('#player').slideDown('slow'); /*Et enfin, on affiche la video a l'ecran de l'utilisateur*/


		return false;
	});



	$('#player').on('click', function(){

		$('#player').slideUp('slow'); /*On cache le lecteur avec un slideUp*/
		$('#player').empty(); /*Et on le vide*/
	});



	/*IMAGES*/


	var index;
	var previous;
	var next;

	var slider = function(){
		index = parseInt($(this).attr('data-index'))+1; /*On récupère l'index de l'image courante*/
		var url = $(this).attr('href'); /*On récupère l'url de l'image courante*/
		var description = $(this).attr('data-description'); /*On récupère la description de l'image courante*/
		var alt = $(this).attr('data-alt'); /*On récupère le alt de l'image courante*/


		$('#slider>img').fadeOut(1000);
		$('#slider>h3').remove();	//
		$('#slider>img').remove();	// On supprime les élements présent dans l'afficheur
		$('#slider>p').remove();	//

		var previousindex = index - 1; // on incrémente l'index courant pour obtenir les information de l'image précédente
		var nextindex = index + 1; // on incrémente l'index courant pour obtenir les information de l'image suivante


		previous = $('li:nth-child('+previousindex+')>a'); // on récupère les données de l'image précédente
		next = $('li:nth-child('+nextindex+')>a'); // on récupère les données de l'image suivante

		var previousurl = previous.attr('href');				// on récupère les données de l'image précédente
		var previousdesc = previous.attr('data-description');	//
		var previousalt = previous.attr('data-alt');			//
		var previousindex = previous.attr('data-index');		//


		var nexturl = next.attr('href');						// on récupère les données de l'image suivante
		var nextdesc = next.attr('data-description');			//
		var nextalt = next.attr('data-alt');					//
		var nextindex = next.attr('data-index');				//

		$('#previous').attr('href', previousurl);				// on insère les données de l'image précédente dans un lien
		$('#previous').attr('data-description', previousdesc);	//
		$('#previous').attr('data-alt', previousalt);			//
		$('#previous').attr('data-index', previousindex);		//

		$('#next').attr('href', nexturl);						// on insère les données de l'image suivante dans un lien
		$('#next').attr('data-description', nextdesc);			//
		$('#next').attr('data-alt', nextalt);					//
		$('#next').attr('data-index', nextindex);				//

		$('#slider').append('<h3>'+alt+'</h3>');					// on envoie les données de l'image courante a l'afficheur
		$('#slider').append('<img src="'+url+'" alt="'+alt+'"/>');	//
		$('#slider').append('<p>'+description+'</p>');				//

		
		$('#slider').slideDown('slow');		// On affiche l'image et les liens a l'écran de l'utilisateur


		return false; // on return false pour annulé le comportement par defaut du navigateur
	}


	$('.images').on('click', slider); // on affiche l'image cliqué de la liste principal

	$('#slider>a').on('click', slider); // on affiche l'image précédente ou suivante en fonction de lien cliqué

	$('#slider').on('click', function(){ // on cache l'afficheur et on supprime son contenu

		$('#slider').slideUp('slow');
		$('#slider>img').remove();

	});

	/*ACTUS*/

	$('.article').on('click', function(){ // on affiche l'article souhaiter dans une fenetre modal
		var title = $(this).attr('href');
		var description = $(this).attr('data-description');
		
		$('#presse').empty(); // on commencer par vider l'afficheur s'il dispose d'un contenu
		$('#presse').append('<h3>'+title+'</h3>'); // on ajoute le nouveau titre
		$('#presse').append('<p>'+description+'</p>') // et ca description

		$('#presse').slideDown('slow'); // et on affiche la fenetre


		return false; // on return false pour annulé le comportement par defaut du navigateur
	});



	$('#presse').on('click', function(){ // on vide l'afficheur des articles

		$('#presse').slideUp('slow'); // on cache la fenetre
		$('#presse').empty(); // et on la vide de son contenu
	});




});