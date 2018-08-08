<?php
/**
 * Social Menus
 *
 * @package Baltic
 */

if ( has_nav_menu ( 'menu-3' ) ) : ?>
	<div class="social-links">
	<?php wp_nav_menu( array(
		'theme_location' 	=> 'menu-3',
		'depth' 			=> 1,
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" itemscope itemtype="http://schema.org/Organization"><link itemprop="url" href="'. esc_url( home_url('/') ) .'">%3$s</ul>',
		'link_before' 		=> '<span class="screen-reader-text">',
		'link_after' 		=> '</span>',
		'container_class' 	=> 'container',
	) ); ?>
	</div>
<?php endif; ?>
