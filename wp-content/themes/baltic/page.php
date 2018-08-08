<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

				get_template_part( 'components/content', 'page' );

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
