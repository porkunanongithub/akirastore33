<?php
/**
 * The template part for displaying slider
 *
 * @package VW Newspaper 
 * @subpackage vw_newspaper
 * @since VW Newspaper 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="row">
    <div class="date-monthwrap">
       <span class="date-month"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
       <span class="date-day"><?php echo esc_html( get_the_date( 'd') ); ?></span>
       <span class="date-year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
    </div>
    <div class="post-main-box">
      <div class="box-image">
        <?php 
          if(has_post_thumbnail()) { 
            the_post_thumbnail(); 
          }
        ?>  
      </div>
      <h3 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>      
      <div class="new-text">
        <?php the_excerpt();?>
      </div>
      <div class="content-bttn">
        <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small hvr-sweep-to-right" title="<?php esc_attr_e( 'Read More', 'vw-newspaper' ); ?>"><?php esc_html_e('Read More','vw-newspaper'); ?></a>
      </div>
    </div>
  </div> 
</div>