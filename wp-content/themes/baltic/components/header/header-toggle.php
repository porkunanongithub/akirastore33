<?php
/**
 * Header toggle
 *
 * @package Baltic
 */

?>
<button class="header-menu-toggle" aria-controls="site-navigation" aria-expanded="false">
	<?php
	Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'menu' ) );
	Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'close' ) );
	echo '<span class="screen-reader-text">' . esc_html__( 'Toggle Main Navigation', 'baltic' ) . '</span>';
	?>
</button>
