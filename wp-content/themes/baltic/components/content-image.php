<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Caspian
 */

do_action( 'baltic_entry_before' );
?>
<article <?php Baltic_Markup::attr( 'post' );?>>
	<div class="entry-inner">

		<div class="post-thumbnail">
			<?php echo wp_get_attachment_image( get_the_ID(), 'full' );?>
		</div><!-- .post-thumbnail -->

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content();?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php get_template_part( 'components/entry/meta', 'edit_link' );?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'baltic_entry_after' );?>
