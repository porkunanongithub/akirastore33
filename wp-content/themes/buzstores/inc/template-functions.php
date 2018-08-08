<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package buzstores
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function buzstores_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    if(buzstores_is_woocommerce_activated()){
        $classes[] = 'woocommerce';
    }
    
    $buzstores_boxed_layout_enable = get_theme_mod('buzstores_boxed_layout_enable');
    if($buzstores_boxed_layout_enable){
        $classes[] = 'boxed-layout';
    }
    /** Sidebar Clsses **/
    global $post;
    $sidebar_meta_option = 'right-sidebar';
    if(is_archive()) {
        $sidebar_meta_option = esc_attr(get_theme_mod( 'buzstores_archive_sidebar_layout', 'right-sidebar' ));
        $classes[] = $sidebar_meta_option;
    }else{
        
        if(is_page_template( 'template-parts/template-home.php' )){
            $classes[] = 'no-sidebar';
        }else{
            if( 'post' === get_post_type() ) {
                $sidebar_meta_option = esc_attr(get_post_meta( $post->ID, 'buzstores_post_sidebar_layout', true ));
                $classes[] = $sidebar_meta_option;
            }
            
            if(buzstores_is_woocommerce_activated()){
                if(is_product()){
                    $classes[] = 'no-sidebar';
                }
            }
            
            if( 'page' === get_post_type() ) {
            	$sidebar_meta_option = esc_attr(get_post_meta( $post->ID, 'buzstores_post_sidebar_layout', true ));
                $classes[] = $sidebar_meta_option;
            }
            
            if( is_home() ) {
                $set_id = get_option( 'page_for_posts' );
        		$sidebar_meta_option = esc_attr(get_post_meta( $set_id, 'buzstores_post_sidebar_layout', true ));
                $classes[] = $sidebar_meta_option;
            }
        }
        
    }
    
	return $classes;
}
add_filter( 'body_class', 'buzstores_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function buzstores_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'buzstores_pingback_header' );
