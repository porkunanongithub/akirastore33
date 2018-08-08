<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * Woocommerce Sidebar
 * 
 * @package Ganess_Store
 */


if(is_active_sidebar('woocommerce')){
	?>
		<div class="cell large-4 medium-4 small-12 cm">
			<?php dynamic_sidebar( 'woocommerce' ); ?>   
		</div><!-- #secondary -->
	<?php
}else{
	?>
		<div class="cell large-4 medium-4 small-12 cm">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>   
		</div><!-- #secondary -->
	<?php
}

