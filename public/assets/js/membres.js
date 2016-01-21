$(function(){

	$('.figure').on('mouseenter', function(){ // quand la souris survol l'article le résumé apparait
		$('.infos>div').stop( false, true );
		$(this).find('.infos>div').animate({
			top: '0',
		}, 500);
	});

	$('.figure').on('mouseleave', function(){ // quand la souris ne survol plus l'article, il disparait
		$('.infos>div').stop( false, true );
		$('.infos>div').animate({
			top: '150px',
		}, 500);
	});

});