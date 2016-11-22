$('body').scrollspy({
	target: '#navbar-example',
	offset: $(window).height() * 0.2
});

//$('.parallax-window').parallax({imageSrc: 'assets/images/light_cross.jpg', bleed: 200});

$('.quotes').parallax({imageSrc: 'assets/images/bible1.jpg', bleed: 200});

$(function(){

	var $window = $(window);
	var scrollTime = 0.3;
	var scrollDistance = 120;

	$window.on("mousewheel DOMMouseScroll", function(event){

		event.preventDefault();

		var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
		var scrollTop = $window.scrollTop();
		var finalScroll = scrollTop - parseInt(delta*scrollDistance);

		TweenMax.to($window, scrollTime, {
			scrollTo : { y: finalScroll, autoKill:true },
				ease: Power1.easeOut,
				overwrite: 5
			});

	});
});
