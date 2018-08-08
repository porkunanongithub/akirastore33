<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Ecommerce Store
 */

get_header(); ?>

<?php do_action( 'bb_ecommerce_store_page_header' ); ?>

<div id="content-bb" class="container">
    <div class="middle-align">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title();?></h1>
            <img src="<?php the_post_thumbnail_url(); ?>" width="100%">
            <?php the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bb-ecommerce-store' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'bb-ecommerce-store' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );

                // If comments are open or we have at least one comment, load up the comment template.
                   if ( comments_open() || get_comments_number() ) :
                       comments_template();
                   endif;
                ?>
        <?php endwhile; // end of the loop. ?>            
    </div>
</div>

<?php do_action( 'bb_ecommerce_store_page_footer' ); ?>

<?php get_footer(); ?>