$(function(){
	$('#section_button').on('click', function(){
		$('#section_song').css('display','block');
		$('#tutti_song').css('display','none');

	});

	$('#tutti_button').on('click', function(){
		$('#section_song').css('display','none');
		$('#tutti_song').css('display','block');
	});

	$(".choregraphy").on('click',function(){
		var href = $(this).attr('href');
		var embed = $(this).attr('data-embed');
		
		$('#player').empty(); /*On video la fenetre du lecteur*/
		/*On ajoute la nouvelle video dans la fenetre du lecteur*/
		$('#player').append('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1024" height="616" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">'+
								'<param name="allowFullScreen" value="true" />'+
								'<param name="allowscriptaccess" value="always" />'+
								'<param name="src" value="'+href+'&amp;hl=fr_FR&amp;fs=1"/>'+
								'<param name="allowfullscreen" value="true" />'+
								'<embed type="application/x-shockwave-flash" width="1024" height="616" src="'+embed+'&amp;hl=fr_FR&amp;fs=1" allowscriptaccess="always" allowfullscreen="true"></embed>'+
							'</object>');
		
		$('#player').slideDown('slow'); /*Et enfin, on affiche la video a l'ecran de l'utilisateur*/
		
		return false;
	});

	$('#player').on('click', function(){

		$('#player').slideUp('slow'); /*On cache le lecteur avec un slideUp*/
		$('#player').empty(); /*Et on le vide*/
	});
});