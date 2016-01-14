$(function(){

	$('.videos').on('click', function(){
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



	$('.images').on('click', function(){

		$('#player').slideUp('slow');
		$('#player').empty();
	});


	var index;
	var previous;
	var next;

	var slider = function(){
		index = parseInt($(this).attr('data-index'))+1;
		var url = $(this).attr('href');
		var description = $(this).attr('data-description');
		var alt = $(this).attr('data-alt');


		$('#slider>img').fadeOut(1000);
		$('#slider>h3').remove();
		$('#slider>img').remove();
		$('#slider>p').remove();

		var previousindex = index - 1;
		var nextindex = index + 1;


		previous = $('li:nth-child('+previousindex+')>a');
		next = $('li:nth-child('+nextindex+')>a');

		var previousurl = previous.attr('href');
		var previousdesc = previous.attr('data-description');
		var previousalt = previous.attr('data-alt');
		var previousindex = previous.attr('data-index');		


		var nexturl = next.attr('href');
		var nextdesc = next.attr('data-description');
		var nextalt = next.attr('data-alt');
		var nextindex = next.attr('data-index');

		$('#previous').attr('href', previousurl);
		$('#previous').attr('data-description', previousdesc);
		$('#previous').attr('data-alt', previousalt);
		$('#previous').attr('data-index', previousindex);

		$('#next').attr('href', nexturl);
		$('#next').attr('data-description', nextdesc);
		$('#next').attr('data-alt', nextalt);
		$('#next').attr('data-index', nextindex);

		$('#slider').append('<h3>'+alt+'</h3>');
		$('#slider').append('<img src="'+url+'" alt="'+alt+'"/>');
		$('#slider').append('<p>'+description+'</p>');

		
		$('#slider').slideDown('slow');			


		return false;
	}


	$('.images').on('click', slider);

	$('#slider>a').on('click', slider);

	$('#slider').on('click', function(){

		$('#slider').slideUp('slow');
		$('#slider>img').remove();

	});




});