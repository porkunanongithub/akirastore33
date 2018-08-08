<?php
/**
 * Primary Menu
 *
 * @package Baltic
 */

$menu_location = apply_filters( 'baltic_primary_menu', 'menu-1' );
?>
<?php if( has_nav_menu( $menu_location ) ) :?>
	<nav <?php Baltic_Markup::attr( 'main-navigation' );?>>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'menu' ) );
			Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'close' ) );
			esc_html_e( 'Menu', 'baltic' );
			?>
		</button>
		<?php
			wp_nav_menu( array(
				'theme_location' 	=> $menu_location,
				'menu_id'        	=> 'primary-menu',
				'container_class' 	=> 'container',
			) );
		?>
	</nav><!-- #site-navigation -->
<?php endif;?>
