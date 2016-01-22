$(function(){

	$('input[name="check"]').on('click', function(){
		if($(this).prop('checked') == true){
			$('label[for="check"]').hide();
			$('label[for="tel"]').show();
		}

		if($(this).prop('checked') == false){
			$('label[for="check"]').show();
			$('label[for="tel"]').hide();
		}
	})

});