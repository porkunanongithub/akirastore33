<?php
/**
 * Ganess Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ganess Store
 */
if( !function_exists('ganess_store_file_directory') ){

    function ganess_store_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
* Customizer
**/
require ganess_store_file_directory('spiderbuzz/customizer/customizer.php');


/**
 * Load Header Class File 
 */
require ganess_store_file_directory('spiderbuzz/hooks/header-hooks.php');
if ( class_exists( 'WooCommerce' ) ) {
	require ganess_store_file_directory('spiderbuzz/hooks/woocommerce.php');
	$Ganess_Store_Woocommerce = new Ganess_Store_Wocommerce();
}
require ganess_store_file_directory('spiderbuzz/hooks/footer-hooks.php');
require ganess_store_file_directory('spiderbuzz/hooks/ganess-store-functions.php');



/**
* Custom Widget Control
**/
require ganess_store_file_directory('spiderbuzz/widget/widget-control/widget-control.php');


/**
* Custom Widget Control
**/
require ganess_store_file_directory('spiderbuzz/settings/inline-css.php');


/** 
* Custom Widget Area 
**/
if(ganess_store_is_woocommerce_activated()){
    require ganess_store_file_directory('spiderbuzz/widget/products-tab.php');
    require ganess_store_file_directory('spiderbuzz/widget/hot-offer.php');
    require ganess_store_file_directory('spiderbuzz/widget/category-products-slider.php');
    require ganess_store_file_directory('spiderbuzz/widget/products-list-widget.php');
    require ganess_store_file_directory('spiderbuzz/widget/featured-upsell-products.php');
    
}
require ganess_store_file_directory('spiderbuzz/widget/homepage-blog.php');
require ganess_store_file_directory('spiderbuzz/widget/news-letter-widget.php');
require ganess_store_file_directory('spiderbuzz/widget/services.php');

//Admin Page
require ganess_store_file_directory('spiderbuzz/admin/class-ganess-store-admin.php');

//Admin Page
require ganess_store_file_directory('spiderbuzz/demo-import/demo-import.php');