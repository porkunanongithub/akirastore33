<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ganess_Store
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!-- <aside id="secondary" class="widget-area"> -->
<div class="cell large-4 medium-4 small-12">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>   
</div>
<!-- </aside>#secondary -->