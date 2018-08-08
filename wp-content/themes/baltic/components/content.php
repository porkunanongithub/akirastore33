<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>
<article <?php Baltic_Markup::attr( 'post' );?>>
	<div class="entry-inner">

		<?php get_template_part( 'components/entry/post', 'thumbnail' );?>

		<header class="entry-header">

			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
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

		<div class="entry-content">
			<?php
				if ( post_password_required() ) {
					get_template_part( 'components/entry/post', 'content' );
				} else {
					the_excerpt();
				}
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
			get_template_part( 'components/entry/meta', 'categories' );
			get_template_part( 'components/entry/meta', 'tags' );
			get_template_part( 'components/entry/meta', 'edit_link' );
			?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
