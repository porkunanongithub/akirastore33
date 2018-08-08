<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<section id="headline">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 p-0">
        <div class="head-title">
          <?php if( get_theme_mod('vw_newspaper_headline_title') != ''){ ?>
            <h3><?php echo esc_html(get_theme_mod('vw_newspaper_headline_title',__('TODAYS HEADLINES','vw-newspaper'))); ?></h3>
          <?php }?>
        </div>
      </div>
      <div class="col-md-9 category-box">
        <div class="row">
          <?php $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('vw_newspaper_headline_category'),'theblog')));?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-4 col-sm-4 p-0">
                    <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="categry">
  <div class="owl-carousel">
    <?php 
      $page_query = new WP_Query(array( 'category_name' => get_theme_mod('vw_newspaper_category','theblog')));?>
      <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
        <div class="imagebox">
          <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
          <div class="main-content-box">
            <div class="date-box">
              <i class="fas fa-calendar-alt"></i><span class="entry-date"><?php echo get_the_date(); ?></span>
              <i class="fas fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
              <i class="fas fa-comments"></i><span class="entry-comments"> <?php comments_number( '0 Comments', '0 Comments', '% Comments' ); ?> </span>
            </div>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          </div>
        </div>
      <?php endwhile; 
      wp_reset_postdata();
    ?>
    <div class="clearfix"></div>
  </div>
</section>

<div id="content-vw" class="container">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>