<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package buzstores
 */

get_header(); ?>
<div class="bs-container">
    <div class="bs-main-wraper">
    	<div id="primary" class="content-area">
    		<main id="main" class="site-main">
    
    			<div class="ht-container">
                    <div class="oops-text"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'buzstores' ); ?></div>
                </div>
                <div class="page-404"></div>
                <div class="page-content">
                
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'buzstores' ); ?></p>
                    
                    <?php get_search_form(); ?>
                
                </div><!-- .page-content -->
    
    		</main><!-- #main -->
    	</div><!-- #primary -->
        
        <?php buzstores_get_sidebar(); ?>
    </div>
</div>
<?php get_footer();