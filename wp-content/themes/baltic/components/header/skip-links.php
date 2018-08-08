<?php
/**
 * Skip links
 *
 * @package Baltic
 */

?>
<?php if( has_nav_menu( 'menu-1' ) ) :?>
	<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to navigation', 'baltic' ); ?></a>
<?php endif;?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'baltic' ); ?></a>
<?php if( is_active_sidebar( 'sidebar-1' ) ) :?>
	<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to Sidebar', 'baltic' ); ?></a>
<?php endif;?>
<?php if( is_active_sidebar( 'sidebar-2' ) ) :?>
	<a class="skip-link screen-reader-text" href="#tertiary"><?php esc_html_e( 'Skip to Footer', 'baltic' ); ?></a>
<?php endif;?>
<?php if( has_nav_menu( 'menu-2' ) ) :?>
	<a class="skip-link screen-reader-text" href="#secondary-navigation"><?php esc_html_e( 'Skip to secondary navigation', 'baltic' ); ?></a>
<?php endif;?>
