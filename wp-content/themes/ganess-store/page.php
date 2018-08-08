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
 * @package Ganess_Store
 */
get_header(); 
do_action('ganess_store_after_header');
do_action('ganess-store-breadcrumb-normal'); 
$ganess_store_page_layout = get_theme_mod('ganess_store_single_page_layout_option','right-sidebar');
?>
	<section id="blog-page">
		<div class="grid-container grid-x grid-padding-x spacing">
			
			<?php  
				if ($ganess_store_page_layout == 'left-sidebar') : 
					get_sidebar('left'); 
				endif;  ?>
				<div class="cell large-8 medium-8  for-search-bx">
					<?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop. ?>
				</div>
				<?php if ($ganess_store_page_layout == 'right-sidebar') : 
					get_sidebar(); 
				endif; 
				?>
			
		</div>
    </section>

<?php
get_footer();