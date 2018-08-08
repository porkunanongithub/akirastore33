<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ganess_Store
 */
get_header(); 
do_action('ganess_store_after_header');
do_action('ganess-store-breadcrumb-normal');
$ganess_store_page_layout = get_theme_mod('archive_page_layout_option','right-sidebar');
?>
	<section id="blog-page" <?php post_class('blog-page'); ?>>
	    <div class="grid-container grid-x grid-padding-x spacing">
	    	<?php  
				if ($ganess_store_page_layout == 'left-sidebar') : 
					get_sidebar('left'); 
				endif; 
			?>
			<div class="cell large-8 medium-8 for-search-bx">
			<div class="grid-x grid-padding-x">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php
				endif; 
					while ( have_posts() ) : the_post(); 

						get_template_part( 'template-parts/content', get_post_format() );

					endwhile; 
				?>
	          	</div>
	          
	          <div class="wraper-pagination">
				<?php the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( '<i class="fa fa-arrow-left"></i> Prev', 'ganess-store' ),
						'next_text' => __( 'Next <i class="fa fa-arrow-right"></i>', 'ganess-store' ),
					) ); 
				?>
				</div>
	          </div>
	          <?php  
				if ($ganess_store_page_layout == 'right-sidebar') : 
					get_sidebar(); 
				endif; 

			else :
				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div>
	</div>
    </section>
<?php
get_footer();
