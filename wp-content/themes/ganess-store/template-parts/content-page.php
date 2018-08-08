<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ganess_Store
 */

?>

  <div>
    <?php if(has_post_thumbnail( )): ?>
    <div class="headline">
      <?php the_post_thumbnail(); ?>
      
    </div>
  <?php endif; ?>
    <div class="title">
      <h1><?php the_title(); ?></h1>
    </div>
    <?php the_content(); 
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ganess-store' ),
			'after'  => '</div>',
		) );
	?>
    
  </div>
