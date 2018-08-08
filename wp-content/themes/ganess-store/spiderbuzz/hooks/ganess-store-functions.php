<?php
/**
 * Ganess Store WooCommerce Breadcrumbs Function
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'ganess_store_woocommerce_breadcrumbs' );
function ganess_store_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &#47; ',
        'wrap_before' => '<span><i class="fa fa-home" aria-hidden="true"></i>',
        'wrap_after'  => '</span>',
        'before'      => '',
        'after'       => '',
        'home'        => esc_html__( 'Home', 'ganess-store'),
    );
}
/**
 * Ganess Store Breadcrumbs Function Area
*/
if ( ! function_exists( 'ganess_store_breadcrumb_woocommerce' ) ) {    
    function ganess_store_breadcrumb_woocommerce() {
        $breadcrumb_options = get_theme_mod('ganess_store_wocommerce_breadcrumb_enable',true);
        $breadcrumb_title = get_theme_mod('ganess_store_breadcrumb_menu_enable', false);

        if($breadcrumb_options == 'enable') { ?>
            <div id="ganess-store-header" class="grid-container full header " > 
                <div class="grid-container grid-x breadcrumb">
                    <?php if($breadcrumb_title == true) { ?>
                        <?php if( is_search() ) { ?>                    
                                <h2 class="entry-title breadcrumb_title"><?php printf( esc_html__( 'Search Results for: %s', 'ganess-store' ), '<span>' . get_search_query() . '</span>' ); ?><h2>
                        <?php }elseif( is_404() ) { ?>                    
                                <h2 class="entry-title breadcrumb_title"><?php echo esc_html__('404','ganess-store'); ?><h2>
                        <?php }else{ ?>
                                <?php the_title( '<h2 class="entry-title breadcrumb_title">', '</h2>' ); ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if( ganess_store_is_woocommerce_activated() ){ woocommerce_breadcrumb(); }  ?>
                </div>
            </div>
        <?php }
    }
}
add_action( 'ganess-store-breadcrumb-woocommerce', 'ganess_store_breadcrumb_woocommerce' );
add_action( 'ganess-store-breadcrumb-normal', 'ganess_store_breadcrumb_woocommerce' );