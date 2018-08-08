<?php
/**
 * Template part for displaying audio posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>
<article <?php Baltic_Markup::attr( 'post' );?>>
	<div class="entry-inner">

		<?php if ( ! post_password_required() ) : ?>
		<div class="entry-media">
			<?php Baltic_Components::media( array( 'type' => 'audio', 'split_media' => true ) );?>
		</div>
		<?php endif;?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta">
				<?php
				if ( ! Baltic_Utility::is_sticky() ) {
					get_template_part( 'components/entry/meta', 'posted_on' );
				}
				get_template_part( 'components/entry/meta', 'posted_by' );
				get_template_part( 'components/entry/meta', 'comments' );
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			if ( ! post_password_required() ) {
				the_excerpt();
			} else {
				get_template_part( 'components/entry/post', 'content' );
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
