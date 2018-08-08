<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

$sidebar = apply_filters( 'baltic_sidebar_tertiary', 'sidebar-2' );
$col = Baltic_Options::get_option( 'footer_widgets_col' );

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside <?php Baltic_Markup::attr( 'tertiary' );?>>
	<div class="container">
		<div class="columns columns-<?php echo absint( $col );?>">
			<?php dynamic_sidebar( $sidebar ); ?>
		</div><!-- .columns -->
	</div><!-- .container -->
</aside><!-- #tertiary -->
