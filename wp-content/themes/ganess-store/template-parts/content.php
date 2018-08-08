<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ganess_Store
 */

?>
<div class="cell large-6 medium-6">
  <div class="blog-list">
    
      <div class="headline">
        <?php if(has_post_thumbnail()): ?>
        <?php the_post_thumbnail('ganess-store-blog'); ?>
        <?php else: ?>
          <img width="352" height="220" src="<?php echo get_template_directory_uri(). "/assets/images/default.png"; ?>" />
        <?php endif; ?>
        <div class="date">
          <span class="num"><?php echo esc_html(get_the_date( 'd' )); ?></span>
          <span class="month"><?php echo esc_html(get_the_date( 'M' )); ?></span>
          <span class="year"><?php echo esc_html(get_the_date( 'Y' )); ?></span>
        </div>
      </div>
    
    <div class="title">
      <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
      <p><?php the_excerpt(); ?></p>
      <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('read more','ganess-store'); ?></a>
    </div>
  </div>
</div>