<?php
/**
 * The template part for displaying slider
 *
 * @package VW Newspaper
 * @subpackage vw-newspaper
 * @since VW Newspaper 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="entry-content">
        <h1><?php the_title();?></h1>    
        <div class="entry-attachment">
            <div class="attachment">
                <?php vw_newspaper_the_attached_image(); ?>
            </div>

            <?php if ( has_excerpt() ) : ?>
                <div class="entry-caption">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
        </div>    
        <?php
            the_content();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'vw-newspaper' ),
                'after'  => '</div>',
            ) );
        ?>
    </div>    
    <?php edit_post_link( __( 'Edit', 'vw-newspaper' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
    <div class="clearfix"></div>
</div>