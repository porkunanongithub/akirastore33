jQuery(document).ready(function($) {
    $('.btn-close').click(function() {
        $('.promotional-block').hide();
    });

    //Header Search form show/hide
    $('html').click(function() {
        $('.site-header .form-holder').slideUp();
    });

    $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });
    $("#btn-search").click(function() {
        $(".site-header .form-holder").slideToggle();
        return false;
    });
    
    var rtl;
    
    if( blossom_feminine_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }
    
    //banner slider
    $('#banner-slider').owlCarousel({
        loop       : true,
        margin     : 0,
        nav        : true,
        items      : 1,
        dots       : false,
        autoplay   : false,
        lazyLoad   : true,
        rtl        : rtl,
        animateOut : blossom_feminine_data.animation,
    });

    // Script for back to top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#blossom-top').fadeIn();
        } else {
            $('#blossom-top').fadeOut();
        }
    });

    $("#blossom-top").click(function() {
        $('html,body').animate({ scrollTop: 0 }, 600);
    });

    //match height
    $('.post-navigation .nav-links .nav-holder').matchHeight();
    $('.archive #primary .post').matchHeight();
    $('.search #primary .search-post').matchHeight();

    //Responsive menu
    var winWidth = $(window).width();
    if (winWidth < 1025) {
        $('#site-navigation ul li.menu-item-has-children').append('<span class="fa fa-angle-down"></span>');
        $('#site-navigation ul li .fa').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#primary-toggle-button').click(function() {
            $('.main-navigation').slideToggle();
        });
    }

    //secondary menu
    if (winWidth < 768) {
        $('.secondary-nav ul li.menu-item-has-children').append('<span class="fa fa-angle-down"></span>');
        $('.secondary-nav ul li .fa').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#secondary-toggle-button').click(function() {
            $('.secondary-nav').slideToggle();
        });
    }

    //sticky kit
    if(winWidth > 767){
        $(".single #primary .post .text-holder .entry-content .social-share").stick_in_parent({
            offset_top: 60,
        });
    }

    //wow
    new WOW().init();
});