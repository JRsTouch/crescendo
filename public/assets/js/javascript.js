$(function(){

	$(window).load(function() { // slider des actualités
	  $('#actusslide').flexslider({
		   animation: "slide",
	    animationLoop: false,
	    itemWidth: 210,
	    itemMargin: 5,
	    minItems: 1,
	    maxItems: 3
	  });
	});

	$(window).load(function() { // slider des vidéos
	  $('#slider').flexslider({
	    animation: "slide",
	    slideshow: false
	  });
	});


	$(window).load(function() { // slider des images
	  $('#carousel').flexslider({
	    animation: "slide"
	  });
	});

	$('button[name=sent]').on('click', function(){ // au click sur le boutton du formulaire on vérifie les champs avant de l'envoyer

		$('form>label>p').remove();

		var name = $('input[name=name]').val();
		var email = $('input[name=email]').val();
		var message = $('textarea[name=message]').val();



		$.ajax({
			url: '/contact',
			type: 'POST',
			dataType: 'json',
			data: {name: name, email: email, message: message},
		})
		.done(function(data){
			console.log("success");
			if(data['errors']['name'] != undefined){
				$('label[for=name]').append('<p>'+data['errors']['name']+'</p>');
				$('label[for=name]>input').css('border', '1px solid #ff745d');
			}
			if(data['errors']['email'] != undefined){
				$('label[for=email]').append('<p>'+data['errors']['email']+'</p>');
				$('label[for=email]>input').css('border', '1px solid #ff745d');
			}
			if(data['errors']['message'] != undefined){
				$('label[for=message]').append('<p>'+data['errors']['message']+'</p>');
				$('label[for=message]>textarea').css('border', '1px solid #ff745d');
			}
			if(data['success'] == true){
				$('form').remove();
				$('form p').remove();
				$('#contact .container').append('<p>“Merci, votre demande a bien été prise en compte, je répondrais incessamment sous peu.”</p>');	
			}
			

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		return false;
	
	});

	$('#actusslide article').on('mouseenter', function(){ // quand la souris survol l'article le résumé apparait
		$('.infoactu').stop( false, true );
		$(this).find('.infoactu').animate({
			top: '0',
			height: '100%',
		}, 500);
	});

	$('#actusslide article').on('mouseleave', function(){ // quand la souris ne survol plus l'article, il disparait
		$('.infoactu').stop( false, true );
		$('.infoactu').animate({
			top: '195px',
			height: 'auto',
		}, 500);
	});

	var topFix = $('#posfixed');
	var offset = topFix.offset().top;

	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	    
	    if (scroll >= offset) {
	        topFix.addClass("fixed");
	        topFix.css('box-shadow', '0px 3px 20px #29237B');
	    } else if (scroll < offset){
	        topFix.removeClass("fixed");
	        topFix.css('box-shadow', 'none');
	    }
	});

	$('#goup').on('click', function(){
		$('html, body').animate({
			scrollTop:$('body').offset().top
		}, 1000);
		return false;
	});
	

	

	


});