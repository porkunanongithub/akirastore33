<?php
/**
 * Template Name: Baltic - Content Sidebar
 * Template Post Type: post, page
 *
 * @package Baltic
 */

add_filter( 'baltic_site_layout', array( 'Baltic_Layout', 'get_content_sidebar' ) );

get_header();

get_template_part( 'components/jumbotron', 'singular' );
?>

<div class="container">
	<div class="columns">

		<?php do_action( 'baltic_primary_before' );?>

		<div <?php Baltic_Markup::attr( 'primary' );?>>
			<main <?php Baltic_Markup::attr( 'site-main' );?>>

			<?php
			while ( have_posts() ) :
				the_post();

				if ( is_singular( 'post' ) ) {
					
					get_template_part( 'components/content', 'single' );

					get_template_part( 'components/menus/nav', 'post' );

				} elseif ( is_singular( 'page' ) ) {

					get_template_part( 'components/content', 'page' );

				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'baltic_primary_after' );?>

	</div><!-- .columns -->
</div><!-- .container -->

<?php
get_footer();
