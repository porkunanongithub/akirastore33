<?php
/**
 * Use: Frontpage settings
 * Description: this page tuggle front and index page
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package eCommerce Lite 
 */

 /** Header section */
get_header(); 

/**
 * Frontpage settings hear
 */
if ( 'posts' == get_option( 'show_on_front' ) ) { 
    //Call the Index page hear
    include( get_home_template() );
}else{ 
    //slider section call
    do_action('ganess_store_slider'); 

    /*Full Width Homepage  Widget Area */
    dynamic_sidebar( 'home_page' );
}

/** Start Footer Section */
get_footer();