<?php
/**
 * Singular jumbotron
 *
 * @package Baltic
 */
?>

<div <?php Baltic_Markup::attr( 'jumbotron-header' );?>>
	<div class="container">
		<?php
		echo '<div class="jumbotron-header-inner">';

			echo sprintf( '<h1 class="jumbotron-title">%s</h1>',
				esc_html( get_the_author() )
			);

			echo sprintf( '<div class="jumbotron-description">%s</div>',
				wp_kses_post( wpautop( get_the_author_meta('description' ) ) )
			);

			Baltic_Components::do_breadcrumb();

		echo '</div>';
		?>
	</div><!-- .container -->
</div><!-- #page-header -->
