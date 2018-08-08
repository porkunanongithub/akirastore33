<?php
/**
 * Template Name: Baltic - Homepage
 * Template Post Type: page
 *
 * @package Baltic
 */
add_filter( 'baltic_site_layout', '__return_false' );
get_header();?>

	<main <?php Baltic_Markup::attr( 'site-main' );?>>

		<?php
			if ( ! defined( 'BALTIC_KIT_NAME') ) {
				get_template_part( 'components/homepage/section', 'hero' );

				if ( is_customize_preview() ) {
					echo '<div class="baltic-require-plugin">';
					echo esc_html__( 'Please install and activate Baltic Kit to get more sections for homepage area.', 'baltic' );
					echo '</div>';
				}

			} else {
				do_action( 'baltic_homepage' );
			}
		?>

	</main><!-- .site-main -->

<?php
get_footer();
