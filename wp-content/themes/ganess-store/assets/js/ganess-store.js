/***************************************************************************
*								Project Tab Ajax Call 
***************************************************************************/
jQuery(document).ready( function(){
    // Listen for resize changes
    window.addEventListener("resize", function() {
        window.location.reload()
    }, false);

    jQuery('#product-tabs').on('click', 'li.tabs-title', function(e) { 
        e.preventDefault();
        var product_cat_id = jQuery(this).attr( 'id' );
        var tab_product_count = jQuery(this).attr('product_count');

        jQuery.ajax({
            url : GANESS.ajaxurl,
            type : 'post',
            data : {
                action : 'category_tab_products',
                post_id : product_cat_id,
                post_id1 : tab_product_count
            },
            success : function( response ) {
                jQuery('.tabs-content').html(response);
                jQuery(window).trigger('resize');
                
            },
            beforeSend: function() {
                    jQuery('.tabs-content').html('<br /><br /><div class="ajax-loader" style="height:320px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only"></span></div>');
                }
        });
                    
    });     
});
