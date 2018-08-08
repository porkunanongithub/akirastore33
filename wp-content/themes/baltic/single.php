<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Baltic
 */

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

				get_template_part( 'components/content', 'single' );

				get_template_part( 'components/menus/nav', 'post' );

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
