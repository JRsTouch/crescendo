$(function(){

	$( "#datepicker" ).datepicker({
		inline: true,
		onSelect: function(e) {
			
			var day = e.substr(0,2);
			var mounth = e.substr(3,2);
			var year = e.substr(6,8);

			$.ajax({
				url: '/calendar',
				data: {day: day, mounth: mounth, year: year, },
			})
			.done(function(data) {
				console.log("success");
				var myData = JSON.parse(data);
				if(myData.length != 0){
					console.log(myData);
					$('#calendar').remove();
					$('body').append('<div id="calendar"></div>');
					$('#calendar').append('<div id="calcontent"></div>');
					$('#calcontent').append('<h3>Evenement du '+e+'</h3>')
					$(myData).each(function(i) {
						$('#calcontent').append('<div class="evenement"></div>');
						$('.evenement').append('<p>'+myData[i]['heure']+'</p>');
						$('.evenement').append('<p>'+myData[i]['description']+'</p>');
					});
				}

				$('#calendar').on('click', function(){
					$('#calendar').remove();
				});
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
			
		}
	});


	$( "#dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);

});