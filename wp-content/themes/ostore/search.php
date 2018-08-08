<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
		<div class="<?php echo esc_attr( ostore_main_class() ); ?>" id="center_column">
		<header class="page-header">
			<h2 class="page-title">
			<?php printf( esc_html__( 'Search Results for: %s', 'ostore' ), '<span>' . esc_html(get_search_query()) . '</span>' ); ?></h2>
		</header><!-- .page-header -->
			<?php
			if ( have_posts() ) : ?>
				<ul class="blog-posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
				<?php endwhile; ?>
				</ul>
				<div class="">
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