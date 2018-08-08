<?php
/**
 * The template part for displaying slider
 *
 * @package VW Corporate Business
 * @subpackage vw-corporate-business
 * @since VW Corporate Business 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="post-info">
      <i class="fa fa-calendar" aria-hidden="true"></i><span class="entry-date"><?php the_date(); ?></span>
      <i class="fa fa-user" aria-hidden="true"></i><span class="entry-author"> <?php the_author(); ?></span>
      <i class="fa fa-comments" aria-hidden="true"></i><span class="entry-comments"> <?php comments_number( __('0 Comments','vw-corporate-business'), __('0 Comments','vw-corporate-business'), __('% Comments','vw-corporate-business') ); ?></span> 
    </div>
    <?php if(has_post_thumbnail()) { ?>
            <div class="feature-box">   
                <img src="<?php the_post_thumbnail_url('full'); ?>"  width="100%">
            </div>                 
        <?php } the_content();
        the_tags(); ?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
        comments_template();

        if ( is_singular( 'attachment' ) ) {
            // Parent post navigation.
            the_post_navigation( array(
                'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'vw-corporate-business' ),
            ) );
        } elseif ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'vw-corporate-business' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'vw-corporate-business' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'vw-corporate-business' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'vw-corporate-business' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
        }
    ?>
</div>