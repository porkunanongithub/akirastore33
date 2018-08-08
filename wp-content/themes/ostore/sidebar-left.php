<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oStore
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}
?>
<div class="col-md-3 col-xs-12">
	<aside id="left-sidebar" class="widget-area">
		<?php dynamic_sidebar( 'left-sidebar' ); ?>
	</aside><!-- #secondary -->
</div>