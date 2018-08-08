<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			endif; 
			
			while ( have_posts() ) : the_post();
	
				get_template_part( 'template-parts/content', 'single' );
				
				wp_link_pages();
				
				the_post_navigation();
				
		?>
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				echo wp_kses_post("<h1>Comments</h1>","ganess-store");
				comments_template();
			endif;
		?>
</div>

<?php  
	if ($ganess_store_page_layout == 'right-sidebar') : 
		get_sidebar(); 
	endif;

endwhile; // End of the loop.
?>
</section>
<?php
get_footer();
