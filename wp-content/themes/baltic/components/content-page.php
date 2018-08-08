<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

do_action( 'baltic_entry_before' );
?>
<article <?php Baltic_Markup::attr( 'post' );?>>
	<div class="entry-inner">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title"><span class="screen-reader-text">', '</span></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php get_template_part( 'components/entry/post', 'content' );?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
			<?php get_template_part( 'components/entry/meta', 'edit_link' );?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'baltic_entry_after' );?>
