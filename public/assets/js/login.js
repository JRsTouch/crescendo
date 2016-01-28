$(function(){

	$('input[name="check"]').on('click', function(){
		if($(this).prop('checked') == true){
			$('label[for="check"]').hide();
			$('label[for="tel"]').show();
			$('input[name="tel"]').show();
			$('input[name="check"]').css('top', '18px');
		}

		if($(this).prop('checked') == false){
			$('label[for="check"]').show();
			$('label[for="tel"]').hide();
			$('input[name="tel"]').hide();
			$('input[name="check"]').css('top', '-15px');
		}
	})

});