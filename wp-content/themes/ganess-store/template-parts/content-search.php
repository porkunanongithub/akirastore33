<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ganess_Store
 */

?>
<div class="cell large-6 medium-6" >
  <div class="blog-list">
    <?php if( has_post_thumbnail() ): ?>
      <div class="headline">
        <?php the_post_thumbnail('ganess-store-blog'); ?>
        <div class="date">
          <span class="num"><?php echo esc_html(get_the_date( 'd' )); ?></span>
          <span class="month"><?php echo esc_html(get_the_date( 'M' )); ?></span>
          <span class="year"><?php echo esc_html(get_the_date( 'Y' )); ?></span>
        </div>
      </div>
    <?php endif; ?>
    <div class="title">
      <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
      <p><?php the_excerpt(); ?></p>
      <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('read more','ganess-store'); ?></a>
    </div>
  </div>
</div>