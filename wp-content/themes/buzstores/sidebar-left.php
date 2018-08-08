<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buzstores
 */

if ( ! is_active_sidebar( 'buzstores-sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area left-sidebar">
	<?php dynamic_sidebar( 'buzstores-sidebar-2' ); ?>
</aside><!-- #secondary -->
