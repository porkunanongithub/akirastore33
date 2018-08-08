<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oStore
 */
?>
	
  <footer class="ostore-footer">
    <?php if( is_active_sidebar('first_footer') OR 
      is_active_sidebar('second_footer') OR is_active_sidebar('third_footer') OR
      is_active_sidebar('forth_footer') OR is_active_sidebar("fifth_footer")): ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
              <?php dynamic_sidebar( 'first_footer' ); ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 collapsed-block">
            <?php dynamic_sidebar( 'second_footer' ); ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 collapsed-block">
            <?php dynamic_sidebar( 'third_footer' ); ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 collapsed-block">
            <?php dynamic_sidebar( 'forth_footer' ); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <?php do_action('ostore_footer_copyright_section'); 

          $social_links_enable = get_theme_mod('ostore_social_links_enable',true);
          if($social_links_enable == true){ ?>
          <div class="social col-md-4 col-sm-5">
              <?php ostore_social_links(); ?>
        </div>
        <?php } 
            do_action('ostore_footer_payment_logo');
          ?>
        </div>
      </div>
    </div>
  </footer>
  
  <a href="#" class="totop"><i class="fa fa-angle-up"></i></a> 
</div>
<?php wp_footer(); ?>
</body>
</html>
