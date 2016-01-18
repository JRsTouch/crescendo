$(function(){

	$(window).load(function() {
	  $('#actusslide').flexslider({
		   animation: "slide",
	    animationLoop: false,
	    itemWidth: 210,
	    itemMargin: 5,
	    minItems: 1,
	    maxItems: 3
	  });
	});

	$(window).load(function() {
	  $('#slider').flexslider({
	    animation: "slide",
	    slideshow: false
	  });
	});


	$(window).load(function() {
	  $('#carousel').flexslider({
	    animation: "slide"
	  });
	});

	$('button[name=sent]').on('click', function(){

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

	$('#actusslide article').on('mouseenter', function(){
		$(this).find('.infoactu').animate({
			top: '0',
			height: '100%',
		}, 500);
	});

	$('#actusslide article').on('mouseleave', function(){
		$('.infoactu').animate({
			top: '190px',
			height: 'auto',
		}, 500);
	});

});