( function( $ ) {

	var baltic = baltic || {};

	baltic.init = function() {

		baltic.$body 	= $( document.body ),
		baltic.$window 	= $( window ),
		baltic.$html 	= $( 'html' ),
		baltic.$body	= $( 'body'),
		baltic.$header  = $( '.site-header' );

		this.inlineSVG();
		this.fitVids();
		this.smoothScroll();
		this.stickyHeader();
		this.headerMenuToggle();
		this.subMenuToggle();
		this.jumbotronHeader();
		this.headerCartToggle();
		this.returnToTop();
		this.stickyOrder();
		this.entryGallery();
		this.bind();

	};

	baltic.supportsInlineSVG = function() {

		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );

	};

	baltic.inlineSVG = function() {

		if ( true === baltic.supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

	};

	baltic.preloader = function() {

		$( '.site-preloader' ).fadeOut(500);
		baltic.$body.removeClass('preloader-enabled');

	};

	baltic.fitVids = function() {

		$( '#page' ).fitVids({
			customSelector: 'iframe[src^="https://videopress.com"]'
		});

	};

	baltic.smoothScroll = function() {

		var $smoothScroll 		= $( 'a[href*="#page"], a[href*="#content"], a[href*="#site-navigation"], a[href*="#secondary"], a[href*="#tertiary"]' );

		$smoothScroll.click(function(event) {
	        // On-page links
	        if (
	            location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
	            location.hostname === this.hostname
	        ) {
	            // Figure out element to scroll to
	            var target = $(this.hash);
	            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	            // Does a scroll target exist?
	            if (target.length) {
	                // Only prevent default if animation is actually gonna happen
	                event.preventDefault();
	                $('html, body').animate({
	                    scrollTop: target.offset().top
	                }, 500, function() {
	                    // Callback after animation
	                    // Must change focus!
	                    var $target = $(target);
	                    $target.focus();
	                    if ($target.is(':focus')) { // Checking if the target was focused
	                        return false;
	                    } else {
	                        $target.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
	                        $target.focus(); // Set focus again
	                    }
	                });
	            }
	        }
		});

	};

	baltic.stickyHeader = function() {

		baltic.$header.stickit({
			screenMinWidth: 782,
			zIndex: 5
		});

	};

	baltic.headerMenuToggle = function() {

		var $headerMenuToggle 	= $( '.header-menu-toggle' ),
			$mainNav 			= $( '.main-navigation, .site-header-cart' );

		$headerMenuToggle.on( 'click', function( e ){

			e.preventDefault();
			$(this).toggleClass( 'toggled' );
			$mainNav.attr( 'aria-expanded', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});
			$mainNav.toggleClass( 'show' );

		});

	};

	baltic.subMenuToggle = function() {

		$( '.sub-menu-toggle' ).on( 'click', function( e ) {
			e.preventDefault();
			var $this = $( this );
			$this.attr( 'aria-expanded', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});
			$this.toggleClass( 'toggled' );
			var toggleElement = $this.closest( 'li' ).children( '.sub-menu' );
			toggleElement.slideToggle(0);
		});

	};

	baltic.jumbotronHeader = function() {

		$( '.jumbotron-header' ).each( function(){

			var $this = $(this);
			var $hasPostThumbnail = $this.find( '.jumbotron-header-thumbnail' );
			var headerHeight = baltic.$header.height();

			if ( $hasPostThumbnail.length !== 0 ) {
				$this.addClass( 'has-archive-thumbnail' );
				if ( baltic.$window.width() > 768 ) {
					$this.css( 'min-height', 'calc( 75vh - '+ headerHeight +'px )' );
				}
			}

		});

	};

	baltic.headerCartToggle = function() {

		var $cartLink 	= $( 'a.header-cart-link' ),
			$widget 	= $( '.header-cart-content' );

		$cartLink.on( 'click', function( e ) {
			e.stopPropagation();
			e.preventDefault();
			$(this).addClass( 'toggled' );
			$widget.toggleClass( 'show' );
		});

		baltic.$html.click( function( e ) {

			if ( $cartLink.hasClass( 'toggled' ) || $widget.hasClass( 'show' ) ) {
				if( !$( e.target ).is( '.header-cart-content, .header-cart-content *' ) ){
					$cartLink.removeClass( 'toggled' );
					$widget.removeClass( 'show' );
				}
			}

		});

	};

	baltic.matchHeight = function() {

		var	$matchHeightPost 	= $( '.featured-posts' ).find( '.entry-inner' ),
			$matchHeightProduct = $( 'ul.products' ).find( '.entry-product' );

		$matchHeightPost.matchHeight();
		$matchHeightProduct.matchHeight();

	};

	baltic.returnToTop = function() {

		var $returnTop = $( '.return-to-top' );

		baltic.$window.scroll( function () {

		    if ( $(this).scrollTop() > 250 ) {
		        $returnTop.removeClass( 'off' ).addClass( 'on' );
		    }
		    else {
		        $returnTop.removeClass( 'on' ).addClass( 'off' );
		    }

		});

	};

	baltic.stickyOrder = function() {

		$( '#order_review' ).stickit({
			screenMinWidth: 782,
			top: 60,
			zIndex: 0
		});

	};

	baltic.entryGallery = function() {

		var $slider 	 = $( '.entry-media .entry-gallery' );

	    if ( 'undefined' === typeof $slider ) {
	        return;
	    }

	    $slider.each( function() {

			var $this 		 = $(this),
				sliderID 	 = $this.attr('id');

			$( '#' + sliderID + '.entry-gallery' ).not('.slick-initialized').slick({
				lazyLoad: 'progressive',
				infinite: true,
				adaptiveHeight: true,
				slidesToScroll: 1,
				fade: true,
				slidesToShow: 1,
				autoplay: true,
				autoplaySpeed: 5000,
				arrows: false,
	            dots: true,
	            pauseOnHover: false,
	            dotsClass: 'baltic-slick-dots'
			});

	    });

	};

	baltic.bind = function() {

		baltic.$window.on( 'load', function() {
			baltic.preloader();
		});

		baltic.$body.on( 'lazyload', function() {
			baltic.fitVids();
		});

		baltic.$body.on( 'wc_fragments_refreshed', function () {
			baltic.stickyOrder();
		});

		baltic.$body.on( 'afterChange', function () {
			baltic.matchHeight();
		});

	   baltic.$body.on( 'customize-preview-menu-refreshed', function( e, params ) {
	   		e.preventDefault();
	    	if( 'menu-1' === params.wpNavMenuArgs.theme_location ) {
				baltic.subMenuToggle();
	    	}
	    });

		baltic.$body.on( 'afterChange', function () {
		    if ( 'undefined' === typeof jetpackLazyImagesModule ) {
		        return;
		    }
			jetpackLazyImagesModule( $ );
		});

	};

	$( window ).on( 'load', function() {
		baltic.preloader();
	});


	$( function() {

		/** Initialize baltic.init() */
		baltic.init();

	});

} )( jQuery );
