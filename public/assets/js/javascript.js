$(function(){

	$(window).load(function() {
	  $('#slider').flexslider({
	    animation: "slide"
	  });
	});

	$(window).load(function() {
	  $('#carousel').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    itemWidth: 210,
	    itemMargin: 5,
	    minItems: 2,
	    maxItems: 4
	  });
	});

});