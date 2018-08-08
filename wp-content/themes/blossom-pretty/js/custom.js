jQuery(document).ready(function($){    
    
    var rtl, mrtl;
    
    if( blossom_pretty_data.rtl == '1' ){
        rtl = true;
        mrtl = false;
    }else{
        rtl = false;
        mrtl = true;
    }

    //banner layout
    $('.slider-layout-two').owlCarousel({
        loop         : true,
        margin       : 30,
        nav          : true,
        dots         : false,
        autoplay     : false,
        stagePadding : 150,
        rtl          : rtl,
        responsive   : {
            1200: {
                items: 3
            },
            1025: {
                items: 2
            },
            768: {
                items: 2,
                stagePadding: 50
            },
            0: {
                items: 1,
                margin: 10,
                stagePadding: 10
            }
        }
    });    
});