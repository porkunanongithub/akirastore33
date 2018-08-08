<?php
class Ganess_Store_Footer_Hooks{
  
  function __construct(){
    add_action( 'ganess_store_before_footer',array($this,'ganess_store_before_footer_products') ,2 );
    add_action( 'ganess_store_before_footer',array($this,'ganess_store_logo_slider'),2 );
    add_action( 'ganess_store_main_footer',array($this,'ganess_store_main_footer'));
  }
  
    /***************************************************************************
    *                      Footer Before Latest,Upsell and Onsell Poducts
    ***************************************************************************/
    public function ganess_store_before_footer_products() {
      $onsell_upsell_featured_product = get_theme_mod('ganess_store_enable_upsell',false);
    if(ganess_store_is_woocommerce_activated() && $onsell_upsell_featured_product == true ){
    ?>
      <section id="product" class="grid-container">
          <div class="grid-x grid-margin-x grid-margin-y">
            <div class="large-4 medium-4 cell grid-x grid-margin-y">
              <div id="vertical-grid" class="cell large-12 medium-12">
                <h3><?php echo esc_html__('ONSELL Products','ganess-store'); ?></h3>
                <ul>
                  <?php
                    $on_sale = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 4,
                    'meta_query'     => array(
                      'relation' => 'OR',
                        array( // Simple products type
                          'key'           => '_sale_price',
                          'value'         => 0,
                          'compare'       => '>',
                          'type'          => 'numeric'
                          ),
                        array( // Variable products type
                          'key'           => '_min_variation_sale_price',
                          'value'         => 0,
                          'compare'       => '>',
                          'type'          => 'numeric'
                          )
                        )
                  );
                $query = new WP_Query($on_sale);
                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                    ?>
                  <li class="item">
                    <a class="grid-x" href="<?php the_permalink(); ?>">
                      <span class="cell large-3 medium-3 small-3">
                        <?php the_post_thumbnail('ganess-store-product-list'); ?>
                      </span>
                      <span class="cell auto">
                        <h4><?php the_title(); ?></h4>
                        <?php the_excerpt(); ?>
                        <span class="grid-x align-middle">
                          <strong><?php woocommerce_template_loop_price(); ?></strong>
                        </span>
                      </span>
                    </a>
                  </li>
                  <?php } } wp_reset_postdata(); ?>        
                </ul>
                
              </div>
              
            </div>

            <div class="large-4 medium-4 cell grid-x grid-margin-y">
              <div id="vertical-grid" class="cell large-12 medium-12">
                <h3><?php echo esc_html__('UPSELL PRODUCTS','ganess-store'); ?></h3>
                <ul>
                  <?php
                     $upsell_product = array(
                      'post_type'         => 'product',
                      'meta_key'          => 'total_sales',
                      'orderby'           => 'meta_value_num',
                      'posts_per_page'    => 4
                      );
                $query = new WP_Query($upsell_product);
                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                     ?>
                  <li class="item">
                    <a class="grid-x" href="<?php the_permalink(); ?>">
                      <span class="cell large-3 medium-3 small-3">
                        <?php the_post_thumbnail('ganess-store-product-list'); ?>
                      </span>
                      <span class="cell auto">
                        <h4><?php the_title(); ?></h4>
                        <?php the_excerpt(); ?>
                        <span class="grid-x align-middle">
                          <strong><?php woocommerce_template_loop_price(); ?></strong>
                        </span>
                      </span>
                    </a>
                  </li>
                  <?php } } wp_reset_postdata(); ?>        
                </ul>
                
              </div>
              
            </div>

            <div class="large-4 medium-4 cell grid-x grid-margin-y">
              <div id="vertical-grid" class="cell large-12 medium-12">
                <h3><?php echo esc_html__('FEATURED PRODUCTS','ganess-store'); ?></h3>
                <ul>
                  <?php
                     $meta_query   = WC()->query->get_meta_query();
                        $meta_query[] = array(
                            'key'   => '_featured',
                            'value' => 'yes'
                        );
                        $feched_products_args = array(
                            'post_type'   =>  'product',
                            'stock'       =>  1,
                            'showposts'   =>  4,
                            'orderby'     =>  'date',
                            'order'       =>  'DESC',
                            'meta_query'  =>  $meta_query,
                        );
                $query = new WP_Query($feched_products_args);
                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                     ?>
                    <li class="item">
                      <a class="grid-x" href="<?php the_permalink(); ?>">
                        <span class="cell large-3 medium-3 small-3">
                          <?php the_post_thumbnail('ganess-store-product-list'); ?>
                        </span>
                        <span class="cell auto">
                          <h4><?php the_title(); ?></h4>
                          <?php the_excerpt(); ?>
                          <span class="grid-x align-middle">
                            <strong><?php woocommerce_template_loop_price(); ?></strong>
                          </span>
                        </span>
                      </a>
                    </li>
                  <?php } } wp_reset_postdata(); ?>        
                </ul>
                
              </div>
              
            </div>

            
          </div>
      </section>
      <?php  
      } 
    }

    /***************************************************************************
    *                        Ganess Footer Logo Slider
    ***************************************************************************/
    function ganess_store_logo_slider() {
      $client_logo_enable = get_theme_mod('logo_slider_enable');
      $client_logo_title = get_theme_mod('logo_slider_title');
      $client_logo =  get_theme_mod('logo_slide_add'); 
      $client_logo_slider = explode(",",$client_logo,-1);

      if($client_logo_enable == true):
      ?>
        <section id="ourbrand" class="grid-container">
            <?php if(!empty($client_logo_title)): ?><h2 class="section-title text-center"><?php echo esc_html($client_logo_title); ?></h2><?php endif; ?>
            <div class="ourbrand">
            <?php  
                  foreach($client_logo_slider as $client_url){
              ?>
              <img class="logo-slider" src="<?php echo esc_url($client_url); ?>">
              <?php } ?>
            </div>
        </section>
    <?php endif;
    }

    /***************************************************************************
    *                        Ganess Main Footer
    ***************************************************************************/
    function ganess_store_main_footer() {
      
      ?>
        <footer>
            <div class="grid-container">
              <?php if( is_active_sidebar('first-footer-widget') OR is_active_sidebar('footer-second-widget') OR is_active_sidebar('footer-third-widget') OR is_active_sidebar('footer-four-widget') OR is_active_sidebar("footer-fifth-widget")): ?> 
                  <div class="widget grid-margin-x grid-x align-center">
                      <div class="item cell large-3 medium-6 small-12">
                            <?php dynamic_sidebar( 'first-footer-widget' ); ?>
                        </div>
                        <div class="item cell large-1 show-for-large"></div>
                        <div class="item cell large-3 medium-6 small-12">
                          <?php dynamic_sidebar( 'footer-second-widget' ); ?>
                        </div>
                        <div class="item cell large-3 medium-6 small-12">
                            <?php dynamic_sidebar( 'footer-third-widget' ); ?>
                        </div>
                        <div class="item cell large-2 medium-6 small-12">
                            <?php dynamic_sidebar( 'footer-four-widget' ); ?>
                        </div>
                      </div>
                      <div>
                        <ul class="footer-links cell">
                          <?php dynamic_sidebar( 'footer-fifth-widget' ); ?>
                        </ul>
                  </div>
              <?php endif; ?>
                  
            
        <p class="copyright text-center">
          <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ganess-store' ) ); ?>"><?php
                  /* translators: %s: CMS name, i.e. WordPress. */
                  printf( esc_html__( 'Proudly powered by %s', 'ganess-store' ), 'WordPress' );
              ?></a>
              <span class="sep"> | </span><a target="_blank" href="<?php echo esc_url('www.spiderbuzz.com'); ?>">
              <?php
                  /* translators: 1: Theme name, 2: Theme author. */
                  printf( esc_html__( 'Theme: %1$s by %2$s.', 'ganess-store' ), 'Ganess Store', 'SpiderBuzz' );
              ?>
          </a>
          </p>
              <a href="#top" class="back-to-top" data-smooth-scroll><i class="fa fa-angle-up" aria-hidden="true"></i></a>
            </div>
          </footer>
    <?php 
    }

}
new Ganess_Store_Footer_Hooks();