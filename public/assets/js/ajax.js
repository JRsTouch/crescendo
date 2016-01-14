$(function(){

	$('ul a').on('click', function(){
		var url = $(this).attr('href');
		var embed = $(this).attr('data-embed');
		var description = $(this).attr('data-description');
		
		$('#player').empty();
		$('#player').append('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1024" height="616" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">'+
								'<param name="allowFullScreen" value="true" />'+
								'<param name="allowscriptaccess" value="always" />'+
								'<param name="src" value="'+url+'&amp;hl=fr_FR&amp;fs=1"/>'+
								'<param name="allowfullscreen" value="true" />'+
								'<embed type="application/x-shockwave-flash" width="1024" height="616" src="'+embed+'&amp;hl=fr_FR&amp;fs=1" allowscriptaccess="always" allowfullscreen="true"></embed>'+
							'</object>');
		$('#player').append('<p>'+description+'</p>')

		$('#player').slideDown('slow');


		return false;
	});

	$('#player').on('click', function(){

		$('#player').slideUp('slow');
		$('#player').empty();
	});


});