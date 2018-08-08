<?php
/**
 * Front Page Template
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */

get_header(); 


//Fontpage settings
if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    include( get_home_template() );
    
}else{ 
    //Loop the Calling Functions
    
    /*Ostore Main Slider */
    do_action('ostore_main_slider');

    /*Full Width Homepage  Widget Area */
    dynamic_sidebar( 'home_page' ); 

    /*Add the Logo Slider */
    do_action('ostore_client_logo');
    
}

get_footer();