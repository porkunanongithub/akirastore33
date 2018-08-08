jQuery(document).ready(function($){

    /** Menu Toggle **/
    $('#toggle').click(function(){
        $('#toggle').toggleClass('on');
        $('.main-navigation #primary-menu').toggleClass('on');
    });

    /** Top Menu **/
    $('#top-toggle').click(function(){
        $('#top-toggle').toggleClass('on');
        $('.top-navigation #primary-menu').toggleClass('on');
    });

    /** Header Slider **/
    $("#secondary-slider-wrap").owlCarousel({
        nav:false,
        margin: 50,
        items:1,
        autoplay: true,
        dots:true,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
    });

    /** Product Slider **/
    $(".wrap-pro-slider").owlCarousel({
        nav:true,
        margin: 20,
        items:4,
        dots:false,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });

    /** sidebar Product Slider **/
    $(".side-pro-slider").owlCarousel({
        nav:true,
        margin: 10,
        items:2,
        dots:false,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });

    /** Testimonial Slider **/
    $(".main-test-loop").owlCarousel({
        dots:false,
        nav:true,
        margin: 10,
        items:2,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:1
            },
            650:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });

    /** Blog Slider **/
    $(".blog-loop-wrap").owlCarousel({
        nav:true,
        margin: 20,
        items:3,
        dots:false,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:1
            },
            650:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    /** Product Category Slider **/
    $(".ps-secondary-pro").owlCarousel({
        nav:true,
        items:4,
        dots:false,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:2
            },
            500:{
                items:2
            },
            650:{
                items:3
            },
            1000:{
                items:3
            },
            1400:{
                items:4
            }
        }
    });

    /** Multiple Product Category Slider **/
    $(".multiple-cat-product").owlCarousel({
        nav:true,
        items:4,
        dots:false,
        margin: 20,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:2
            },
            900:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });
    /** Multiple Product Category Slider **/
    $(".second-product-loop").owlCarousel({
        nav:true,
        items:1,
        dots:false,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
    });

    //Entrance WOW JS
    var wow = new WOW(
        {
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 150, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
            callback: function (box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            }
        }
    );
    wow.init();

    /** Product Tab **/
    $('.tab-button .cat-name').click(function(){
        wow_tab = new WOW(
          {
              boxClass:     'wow_tab',       //default
              animateClass: 'animated',  //default
              offset:       0,           //default
              mobile:       true,        //default
              live:         true         //default
            }
        );
        wow_tab.init();
       var idtab = this.id;
       $('.wrap-tab-roduct').hide();
       $('.wrap-tab-roduct').removeClass('active');
       $('.tab-button .cat-name').removeClass('active');
       $('.tab-button #'+idtab).addClass('active');
       $('.ps-cat-product #tab-pro-'+idtab).show();
       $('.ps-cat-product #tab-pro-'+idtab).addClass('active');


    });

    /** Scroll Top **/
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });

    //Sickey Sidebar
    $('#secondary, #primary').theiaStickySidebar();
});
