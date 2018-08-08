<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>

<article <?php Baltic_Markup::attr( 'post' );?>>
	<div class="entry-inner">
		<?php Baltic_Components::post_thumbnail();?>

		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				if ( ! Baltic_Utility::is_sticky() ) {
					get_template_part( 'components/entry/meta', 'posted_on' );
				}
				get_template_part( 'components/entry/meta', 'posted_by' );
				get_template_part( 'components/entry/meta', 'comments' );
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php
			get_template_part( 'components/entry/meta', 'categories' );
			get_template_part( 'components/entry/meta', 'tags' );
			get_template_part( 'components/entry/meta', 'edit_link' );
			?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
