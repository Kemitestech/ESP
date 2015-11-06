	$(document).ready(function(){
		$('.slider').slick({
		  dots: true,
		  infinite: true,
		  speed: 470,
		  slidesToShow: 3,
		  slidesToScroll: 3,
		  adaptiveHeight: true,
		  autoplay: true,
		  autoplaySpeed: 8000,
		    responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				dots: true
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		  ]
		});
		
		$('.slider1').slick({
		  dots: true,
		  infinite: true,
		  speed: 450,
		  fade: true,
		  cssEase: 'linear',
		  adaptiveHeight: false
		});		
		
		$('.slider3').slick({
		  dots: true,
		  infinite: true,
		  speed: 450,
		  fade: true,
		  cssEase: 'linear',
		  adaptiveHeight: true
		});		
	});	