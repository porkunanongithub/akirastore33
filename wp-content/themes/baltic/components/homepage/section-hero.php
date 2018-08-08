<?php
/**
 * Baltic Hero section
 *
 * @package Baltic
 */

if ( have_posts() ) : while ( have_posts() ) : the_post();

$thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'post-thumbnail' ) : '';

?>
<div id="homepage__hero" class="homepage__hero" style="background-image:url('<?php echo esc_url( $thumbnail );?>');">
<div class="homepage-overlay">
	<div class="container">
		<div class="homepage__hero-wrap">
			<div class="homepage__hero-inner">
				<div class="homepage__hero-area">

					<h2 class="homepage__hero-title"><?php echo esc_attr( get_the_title() );?></h2>
					<div class="homepage__hero-description">
						<?php the_content();?>
					</div>

				</div><!-- .homepage__hero-area -->
			</div><!-- .homepage__hero-inner -->
		</div><!-- .homepage__hero-wrap -->
	</div><!-- .container -->
</div><!-- .homepage-overlay -->
</div><!-- .homepage__hero -->

<?php
endwhile;
endif;
wp_reset_postdata();
