<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

get_header();
get_template_part( 'components/jumbotron', 'archive' );
?>

<div class="container">
	<div class="columns">

		<?php do_action( 'baltic_primary_before' );?>

		<div <?php Baltic_Markup::attr( 'primary' );?>>
			<main <?php Baltic_Markup::attr( 'site-main' );?>>

			<?php get_template_part( 'components/loop', 'index' );?>

			</main><!-- #main -->

			<?php get_template_part( 'components/menus/nav', 'posts' );?>

		</div><!-- #primary -->

		<?php do_action( 'baltic_primary_after' );?>

	</div><!-- .columns -->
</div><!-- .container -->

<?php
get_footer();
