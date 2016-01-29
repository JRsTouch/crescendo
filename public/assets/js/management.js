$(function(){

	var id;
	var email;
	var role;
	var tel;

	$('.membermanage').on('click', function(){

		id = $(this).attr('data-id');
		email = $(this).attr('data-email');
		role = $(this).attr('data-role');
		tel = $(this).attr('data-tel');
		name = $(this).html();
		$('#manageform>h3').html(name);
		$('#manageform input[name="id"]').val(id);
		$('#manageform input[name="email"]').val(email);
		$('#manageform input[name="tel"]').val(tel);
		console.log(role);
		$('#manageform select>option').each(function() {
			if($(this).val() == role){
				$(this).attr('selected', true);
			}
		});
		$('#manageform').slideDown();
	});

	$('#manageform a').on('click', function(){

		$('#manageform').slideUp();
	});

})