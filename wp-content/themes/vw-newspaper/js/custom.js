(function( $ ) {
	// NAVIGATION CALLBACK
	var ww = jQuery(window).width();
	jQuery(document).ready(function() { 
		jQuery(".nav li a").each(function() {
			if (jQuery(this).next().length > 0) {
				jQuery(this).addClass("parent");
			};
		})
		jQuery(".toggleMenu").click(function(e) { 
			e.preventDefault();
			jQuery(this).toggleClass("active");
			jQuery(".nav").slideToggle('fast');
		});
		adjustMenu();
	})

	// navigation orientation resize callbak
	jQuery(window).bind('resize orientationchange', function() {
		ww = jQuery(window).width();
		adjustMenu();
	});

	var adjustMenu = function() {
		if (ww < 720) {
			jQuery(".toggleMenu").css("display", "block");
			if (!jQuery(".toggleMenu").hasClass("active")) {
				jQuery(".nav").hide();
			} else {
				jQuery(".nav").show();
			}
			jQuery(".nav li").unbind('mouseenter mouseleave');
		} else {
			jQuery(".toggleMenu").css("display", "none");
			jQuery(".nav").show();
			jQuery(".nav li").removeClass("hover");
			jQuery(".nav li a").unbind('click');
			jQuery(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
			});
		}
	}

	jQuery(document).ready(function() {
		var owl = jQuery('.owl-carousel');
			owl.owlCarousel({
				margin: 0,
				nav: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
				responsive: {
				  0: {
				    items: 1
				  },
				  600: {
				    items: 3
				  },
				  1000: {
				    items: 3
				}
			}
		})
	})

	/**** Hidden search box ***/
	jQuery('document').ready(function($){
		$('.search-box span i').click(function(){
	        $(".serach_outer").slideDown(1000);
	    });

	    $('.closepop i').click(function(){
	        $(".serach_outer").slideUp(1000);
	    });
	});	

	$(document).ready(function () {

		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup').fadeIn();
		    } else {
		        $('.scrollup').fadeOut();
		    }
		});

		$('.scrollup').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});

	});
	
})( jQuery );