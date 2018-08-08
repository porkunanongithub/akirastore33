<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 *  Right Sidebar
 * @package Ganess_Store
 */
if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}
?>
<!-- <aside id="secondary" class="widget-area"> -->
<div class="cell large-4 medium-4 small-12">
<?php dynamic_sidebar( 'left-sidebar' ); ?>   
</div>
<!-- </aside>#secondary -->