
jQuery(document).foundation();
$ = jQuery;
jQuery('.back-to-top').click(function (event) {
	event.preventDefault();
	$('html, body').animate({ scrollTop: 0 }, 600);
})



jQuery(".fittext").fitText()

jQuery(document).ready(function(){
	jQuery('.hotoffer').show().slick({
		dots: false,
	    speed: 300,
	    slidesToShow: 1,
	    variableWidth: true,
	    responsive: [
	    {
	      	breakpoint: 639,
	      	settings: {
	        	centerMode: true,
	        	centerPadding: '40px',
	        	slidesToShow: 3
	      	}
	    },
	    ]
	});
	jQuery(".hotoffer-list .slick-arrow").appendTo(".hotoffer-arrow-container");
	
	/** Brand Logo */
 	jQuery('.ourbrand').show().slick({
	  	dots: false,
	  	speed: 300,
	  	slidesToShow: 1,
	  	variableWidth: true,
	  	responsive: [
	    {
	      	breakpoint: 639,
	      	settings: {
	        	centerMode: true,
	        	centerPadding: '40px',
	        	slidesToShow: 5
	      	}
	    },
	    ]
	  });
	
	/**
	 * Slick Slider Js
	 */
	jQuery('.homepage-slider').show().slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: true,
		dots: false,
		speed: 900,
		autoplay: true,
		centerMode: true,
				prevArrow : '<button type="button" class="orbit-previous"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
				nextArrow : '<button type="button" class="orbit-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>'
	});


 	jQuery('.widget_blog_slider').show().slick({
	  	centerMode: true,
	  	centerPadding: '60px',
	  	slidesToShow: 5,
	  	responsive: [
	    {
	      	breakpoint: 1600,
	      	settings: {
	        	centerMode: true,
	        	centerPadding: '40px',
	        	slidesToShow: 3
	      	}
	    },
	    {
	      	breakpoint: 800,
	      	settings: {
	        	centerMode: true,
	        	centerPadding: '40px',
	        	slidesToShow: 1
	      	}
	    }
	  	]
	});
	jQuery("#blog .slick-arrow").appendTo(".blog-arrow-container");
	
});


// Set the date we're counting down to
var countDownDate = new Date("Nov 30, 2017 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

// Get todays date and time
var now = new Date().getTime();

// Find the distance between now an the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	// // Output the result in an element with id="demo"
	// document.getElementById("timer").innerHTML = 
	// '<span>'+days+'<small>Days</small></span>'+':'+
	// '<span>'+hours+'<small>Hours</small></span>'+':'+
	// '<span>'+minutes+'<small>Min</small></span>'+':'+
	// '<span>'+seconds+'<small>Sec</small></span>';

	// If the count down is over, write some text 
	// if (distance < 0) {
	//     clearInterval(x);
	//     document.getElementById("timer").innerHTML = "EXPIRED";
	// }
}, 1000);



jQuery(window).on('resize',function() {
	if($(window).width()>1023){
		$("#main-menu").appendTo('.second-bar .header-right-container');
  		$("#secondary-menu").appendTo('.third-bar');
	}else{
		$("#main-menu").insertAfter('.off-canvas h6');
  		$("#secondary-menu").insertAfter('.off-canvas p');
	}
}).trigger('resize');

jQuery(window).on('resize',function() {
	if($(window).width()>639){
		$('#product #ads').insertAfter('#vertical-grid .initial-flex');
		$('#product #offer').insertAfter('#product #vertical-grid');

		$('#blog-page .search-bx').insertBefore('#blog-page .right-pane');
	}else{
		$('#product #ads').appendTo('#product .mobile-ctrl');
		$('#product #offer').appendTo('#product .mobile-ctrl');

		$('#blog-page .search-bx').prependTo('#blog-page .for-search-bx');
	}
}).trigger('resize');

if (Foundation.MediaQuery.atLeast('large')) {
  
}
// for category
$('.filter-icon-con .filter-icon').click(function(e){
	e.preventDefault();
	e.stopPropagation();
	$(this).parent().toggleClass('is-active');
	$('.filter-box').delay(100).stop().slideToggle('fast');
	return false;
})

jQuery(window).on('resize',function() {
	var itemwidth = $("#horizontal-grid .item").width();
	var sameheight = $("#horizontal-grid .image-container").width();
	var sameheight2 = $("#hotoffer .image-container").width();

	$("#horizontal-grid .image-container").height(sameheight);
	$("#horizontal-grid .button-container").height(sameheight);

	$("#hotoffer .image-container").height(278);
	$("#hotoffer .button-container").height(200);

	$("#hotoffer .item").width(278);

}).trigger('resize');