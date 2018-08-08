<?php
/**
 * Posts Navigation
 *
 * @package Baltic
 */

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
	return;
}

if ( Baltic_Options::get_option( 'products_nav' ) == 'products_navigation' ) {
	the_posts_navigation( array(
        'prev_text'          => esc_html( Baltic_Options::get_option( 'products_nav_prev' ) ),
        'next_text'          => esc_html( Baltic_Options::get_option( 'products_nav_next' ) ),
	) );
} elseif( Baltic_Options::get_option( 'products_nav' ) == 'products_pagination' ) {
	the_posts_pagination( array(
		'prev_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'arrow-left' ) ), __( 'Previous Product', 'baltic' ) ),
		'next_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'arrow-right' ) ), __( 'Next Product', 'baltic' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'baltic' ) . ' </span>',
	) );
}
