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

		$image = get_the_post_thumbnail_url( get_the_id(), 'full' );

		echo '<div class="jumbotron-header-inner">';

		echo sprintf( '<p class="jumbotron-title">%s</p>',
			get_the_title( absint( get_the_id() ) )
		);

		if ( has_post_thumbnail( get_the_id() ) ) {
			echo sprintf( '<div class="jumbotron-header-thumbnail" style="background-image:url(%s)" ></div>',
				esc_url( $image )
			);
		}

		Baltic_Components::do_breadcrumb();

		echo '</div>';

		?>
	</div><!-- .container -->
</div><!-- #page-header -->
