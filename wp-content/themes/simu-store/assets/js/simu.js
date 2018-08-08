(function(jQuery) {
    'use strict';
    jQuery(document).ready(function($) {

   
	/* ============== rd-navbar ============= */
	if( $(".rd-navbar").length){
		
		$('.rd-navbar').RDNavbar({
			stickUpClone: false,
			
		});
	}
	/* -- image-popup */
	if( $('.image-popup').length ){
		
		 $('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	

 });
})(jQuery);