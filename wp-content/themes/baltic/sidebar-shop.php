<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

$sidebar = apply_filters( 'baltic_sidebar_shop', 'sidebar-3' );

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside <?php Baltic_Markup::attr( 'secondary' );?>>
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
