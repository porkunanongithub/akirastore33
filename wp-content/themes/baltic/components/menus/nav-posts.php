<?php
/**
 * Posts Navigation
 *
 * @package Baltic
 */

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
	return;
}

if ( Baltic_Options::get_option( 'nav_posts' ) == 'posts_navigation' ) {
	the_posts_navigation( array(
        'prev_text'          => esc_html( Baltic_Options::get_option( 'nav_posts_prev' ) ),
        'next_text'          => esc_html( Baltic_Options::get_option( 'nav_posts_next' ) ),
	) );
} elseif( Baltic_Options::get_option( 'nav_posts' ) == 'posts_pagination' ) {
	the_posts_pagination( array(
		'prev_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'arrow-left' ) ), esc_html__( 'Previous Page', 'baltic' ) ),
		'next_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'arrow-right' ) ), esc_html__( 'Next Page', 'baltic' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'baltic' ) . ' </span>',
	) );
}
