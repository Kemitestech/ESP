$(document).ready(function() {
		var $window = $(window);
		var $myAffix = $('#myAffix');

		$('.sidebar').affix({
        offset: {
          top: $myAffix.height()+$('.nav-tabs').height()+$('#history-banner').height()+ 100,
          bottom: 550
        }
        });

		$('#sidebargallery').affix({
			offset: {
			  top: $myAffix.height()+100,
			  bottom: 252
			}
		});

		$('#chevron-top').affix({
			offset: {
				top: $myAffix.height()+$('#youth-hero').height(),
				bottom: 0
			}
		});

		// Optimalisation: Store the references outside the event handler:


		function checkWidth() {
			var windowsize = $window.width();
			if (windowsize > 1199) {
				//if the window is greater than 440px wide then turn on jScrollPane..
			   $myAffix.affix({
				  offset: {
					top: $('.navbar').height()-$('#nav').height()
				}});
			}
			else if (windowsize < 2000) {
				//if the window is greater than 440px wide then turn on jScrollPane..
			   $myAffix.affix({
				  offset: {
					top: $('.navbar').height()-$('#nav').height()+700
				}});
			}
		}
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);
});
