<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW Newspaper
 */

get_header(); ?>

<div id="content-vw" class="container">
    <div class="middle-align">
		<?php while ( have_posts() ) : the_post(); ?>
        	<img src="<?php the_post_thumbnail_url('full'); ?>" width="100%">
            <h1><?php the_title();?></h1>
            <?php the_content();?>
        <?php endwhile; // end of the loop. ?>
        <?php
        	//If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() )
                comments_template();
        ?>
    </div>
    <div class="clear"></div>
</div>

<?php get_footer(); ?>