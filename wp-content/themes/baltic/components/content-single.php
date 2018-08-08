<?php
/**
 * Template part for displaying posts
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
			<div class="entry-meta">
			<?php
			get_template_part( 'components/entry/meta', 'posted_on' );
			get_template_part( 'components/entry/meta', 'posted_by' );
			get_template_part( 'components/entry/meta', 'comments' );
			?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
		<?php get_template_part( 'components/entry/post', 'content' );?>
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
<?php do_action( 'baltic_entry_after' );?>
