<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */
$ostore_get_layout = ostore_get_layout();
get_header(); 
ostore_breadcrumb();
?>	
<!-- Main Container -->
<section class="blog_post bounceInUp animated">
    <div class="container">
        <div class="row">
          <?php 
            //Ostore Sidebar Layout 
            if ( $ostore_get_layout == 'left-sidebar' OR $ostore_get_layout == 'both-sidebar' ) : 
              get_sidebar('left'); 
            endif;
          ?>
        <div class="<?php echo esc_attr( ostore_main_class() ); ?>">
          <?php 
            if(have_posts()): 
            while ( have_posts() ) : the_post(); 
                get_template_part( 'template-parts/content', 'page');


                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                  comments_template();
                endif;
              endwhile; 
            else: 
                get_template_part( 'template-parts/content','none'); 
            endif; 
          ?> 
        </div>
        <?php 
            //Ostore Sidebar Layout 
            if ( $ostore_get_layout == 'right-sidebar' OR $ostore_get_layout == 'both-sidebar' ) : 
              get_sidebar(); 
            endif;
          ?>
      </div>
    </div>
  </section>
  <!-- Main Container End -->
<?php
get_footer();