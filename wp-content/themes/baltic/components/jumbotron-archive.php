<?php
/**
 * Archive Jumbotron
 *
 * @package Baltic
 */
?>

<div <?php Baltic_Markup::attr( 'jumbotron-header' );?>>
	<div class="container">
		<?php
		echo '<div class="jumbotron-header-inner">';

			if ( is_archive() ) {
				$term_id 	= get_queried_object()->term_id;
				$image_id 	= get_term_meta( $term_id, 'image', true );
				$image 		= wp_get_attachment_image_src( $image_id, 'full' );

				echo sprintf( '<h1 class="jumbotron-title">%s</h1>',
					esc_html( get_the_archive_title() )
				);

				echo sprintf( '<div class="jumbotron-description">%s</div>',
					wp_kses_post( wpautop( get_the_archive_description() ) )
				);

				if ( ! empty( $image_id ) ) {
					echo sprintf( '<div class="jumbotron-header-thumbnail" style="background-image:url(%s)" ></div>',
						esc_url( $image[0] )
					);
				}
			} elseif ( get_option( 'page_for_posts' ) && is_home() ) {

				$blog_id = get_option( 'page_for_posts' );

				$image = get_the_post_thumbnail_url( $blog_id, 'full' );

				echo sprintf( '<p class="jumbotron-title">%s</p>',
					get_the_title( absint( $blog_id ) )
				);
				echo sprintf( '<div class="jumbotron-description">%s</div>',
					wp_kses_post( wpautop( get_post_field( 'post_content', absint( $blog_id ) ) ) )
				);

				if ( has_post_thumbnail( $blog_id ) ) {
					echo sprintf( '<div class="jumbotron-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
				}
			}

			Baltic_Components::do_breadcrumb();

		echo '</div>';
		?>
	</div><!-- .container -->
</div><!-- #page-header -->
