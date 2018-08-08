<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */
$ostore_archive_sidebar_layout = get_theme_mod('archive_page_layout_option','right-sidebar');
get_header(); 
ostore_breadcrumb();

?>
	
	<!-- Main Container -->
	<section class="blog_post bounceInUp animated">
	<div class="container"> 	
		<!-- row -->
		<div class="row">
		<!-- Center colunm-->
		<?php 
			//Ostore Sidebar Layout 
			if ( $ostore_archive_sidebar_layout == 'left-sidebar' OR $ostore_archive_sidebar_layout == 'both-sidebar' ) : 
				get_sidebar('left'); 
			endif;
		?>
		<div class="<?php echo esc_attr( ostore_main_class() ); ?>" id="center_column">
			
			<?php
			if ( have_posts() ) : ?>
			
				<ul class="blog-posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				<?php endwhile; ?>
				
				</ul>
				<div class="wraper-pagination">
				<?php the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
						'next_text' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
					) ); ?>
				</div>
			<?php else: ?>
				<?php get_template_part( 'template-parts/content','none'); ?>
			<?php endif; ?>
		</div>
		<?php 
			//Ostore Sidebar Layout 
			if ( $ostore_archive_sidebar_layout == 'right-sidebar' OR $ostore_archive_sidebar_layout == 'both-sidebar' ) : 
				get_sidebar(); 
			endif;
		?>
		</div>
		<!-- ./row--> 
	</div>
	</section>
	<!-- Main Container End -->	
<?php
get_footer();