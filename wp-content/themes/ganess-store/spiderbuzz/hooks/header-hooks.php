<?php
class Ganess_Store_Header_Hooks{
  function __construct(){
    add_action( 'ganess_store_before_header',array($this,'ganess_store_top_header'),1 );
    add_action( 'ganess_store_header_logo_section',array($this,'ganess_store_header_logo'),1 );
    
    if( get_theme_mod('ganess_store_header_search_box_enable',true) == true ):
      add_action('ganess_store_before_nav',array($this,'ganess_store_header_search_form'),2);
    endif;
    add_action( 'ganess_store_before_nav',array($this,'ganess_store_mobile_menu'),1 );
    add_action( 'ganess_store_header_account',array($this,'ganess_store_header_account') );

    add_action( 'ganess_store_slider',array($this,'ganess_store_home_slider'), 1 );
  }

  /***************************************************************************
  *                        Ganess Store Top Header
  ***************************************************************************/
  public function ganess_store_top_header() {
    if( get_theme_mod('ganess_store_top_header_enable',true) == true):
    
    //store layout
    $ganess_store_top_header_layout = get_theme_mod( 'ganess_store_top_header_layout','top_header_layout_1' );

    //Store Info
    $top_header_email  = get_theme_mod('ganess_store_contact_email','spiderbuzz@gmail.com');
    $top_header_address = get_theme_mod('ganess_store_location','Kathamandu,Nepal');
    $top_header_phone  = get_theme_mod('ganess_store_phone_no','+977-1234567890');
    ?>
      <div class="grid-container full first-bar">
        <div class="grid-container grid-x">
            <div class="large-6 medium-12 cell top-link">
                <?php if(!empty($top_header_email)): ?><p class="large-text-left text-center m0"><i class="fa fa-envelope-o" aria-hidden="true"></i><small><?php echo esc_html($top_header_email); ?></small></p><?php endif; ?>
                <?php if(!empty($top_header_phone)): ?><p class="large-text-left text-center m0"><i class="fa fa-phone" aria-hidden="true"></i><small><?php echo esc_html($top_header_phone); ?></small></p><?php endif; ?>
                <?php if(!empty($top_header_address)): ?><p class="large-text-left text-center m0"><i class="fa fa-map-marker" aria-hidden="true"></i><small><?php echo esc_html($top_header_address); ?></small></p><?php endif; ?>
            </div>
              <?php
              
              if( $ganess_store_top_header_layout == 'top_header_layout_1'){
                $this-> ganess_store_top_social_links();    
              }else{
                $this-> ganess_store_top_menu();
              }
            
            ?>
        </div>
      </div>
    <?php endif; 
  }


  //top header menu
  public function ganess_store_top_menu() {
    ?>
      <div class="large-6 medium-12 cell top_header">
          <?php 
            wp_nav_menu( 
              array( 'theme_location' => 'top-header-menu',
                      'container' => 'ul',
                      'menu_class'=> 'menu align-center large-text-right hide-for-small-only'
                  ) 
              ); 
          ?>
      </div>
    <?php
  }

  /** Top Header Social Share */
  public function ganess_store_top_social_links() {
      //customizer value
      $facebook_url   = get_theme_mod('facebook_url','www.facebook.com');
      $google_plus    = get_theme_mod('google_plus','www.google-plus.com');
      $pinterest_url  = get_theme_mod('pinterest_url','www.pinterest.com');
      $twitter_url    = get_theme_mod('twitter_url','www.twitter.com');
      $youtube_url    = get_theme_mod('youtube_url','www.youtube.com');
      $linkedin_url   = get_theme_mod('linkedin_url','www.linkdin.com');
    ?>
      <div class="large-6 medium-6 small-12 cell">
        <div class="top_social_links">
          <ul >
              <?php if(!empty($facebook_url)): ?><li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
              <?php if(!empty($twitter_url)): ?><li><a href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php endif; ?>
              <?php if(!empty($google_plus)): ?><li><a href="<?php echo esc_url($google_plus); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php endif; ?>
              <?php if(!empty($linkedin_url)): ?><li><a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php endif; ?>
              <?php if(!empty($pinterest_url)): ?><li><a href="<?php echo esc_url($pinterest_url); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li><?php endif; ?>
              <?php if(!empty($youtube_url)): ?><li><a href="<?php echo esc_url($youtube_url); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li><?php endif; ?>
          </ul>
        </div>
      </div>
    <?php
  }

  /***************************************************************************
  *                        Ganess Store Logo
  ***************************************************************************/
  public function ganess_store_header_logo() {
    ?>
    <div class="logo-container medium-12 large-3 small-12 cell grid-x">        
          <?php the_custom_logo(); ?>
          <?php if (  display_header_text() ) : ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
          <?php endif; ?>
        
      </div>
  <?php  
  }

  /**************************************************************************
  *                         Ganess Store Search Form
  ***************************************************************************/
  public function ganess_store_header_search_form() { ?>
    <div id="search" class="cell large-8 medium-5 grid-x align-middle medium-order-4 large-order-1 small-order-2 small-12">
      <i class="fa fa-search" aria-hidden="true"></i>
          <form name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <?php if (class_exists('WooCommerce')) : ?>
              <?php
              $REQUEST = wp_unslash($_REQUEST);
              if(isset( $REQUEST['product_cat']) && !empty($REQUEST['product_cat']) )
              {
                $optsetlect = $REQUEST['product_cat'];
              }
             else{
                $optsetlect=0;  
            }
              
              
                $args = array(
                    'show_option_all' => esc_html__( 'All Categories', 'ganess-store' ),
                    'hierarchical' => 1,
                    'class' => 'cat',
                    'echo' => 1,
                    'value_field' => 'slug',
                    'selected' => $optsetlect
                );
                $args['taxonomy'] = 'product_cat';
                $args['name'] = 'product_cat';              
                $args['class'] = 'cate-dropdown hidden-xs';
                wp_dropdown_categories($args);

               ?>
              <input type="hidden" value="product" name="post_type">
            <?php endif; ?>
              <input type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search Products', 'ganess-store'); ?>">

            <button type="submit" title="<?php esc_attr_e('Search', 'ganess-store'); ?>" class="search-btn-bg"><span></span></button>
          </form>
      </div> 
    <?php 
  }

  /***************************************************************************
  *                        Ganess Store Account Settings
  ***************************************************************************/
  public function ganess_store_header_account() {
    ?>
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="grid-x align-middle align-right">
          <i class="fa fa-user" aria-hidden="true"></i><div class="hide-for-small-only"></div>
          
          <ul class="menu">
            <?php if (is_user_logged_in()) { ?>
                <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php echo esc_html__('My Account','ganess-store');  ?></a></li>
                <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php echo esc_html__('Sign Out','ganess-store'); ?> </a></li>
            <?php } else{ ?>
                  <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php echo esc_html__('Log In','ganess-store'); ?></a></li>
                  <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php echo esc_html__('Register','ganess-store'); ?></a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    <?php  
  }

  /***************************************************************************
  *                        Ganess Store Mobile Menu
  ***************************************************************************/
  public function ganess_store_mobile_menu() {
    ?>
      <div id="mobile-menu" class="cell medium-3 hide-for-large grid-x align-middle medium-order-3 small-order-1 small-3">
        <button type="button" class="button grid-x align-middle button no-style" data-toggle="full-menu"><i class="hamburger-icon"></i> <span class="hide-for-small-only"><?php echo esc_html__('Menu','ganess-store'); ?></span></button>
      </div>
    <?php  
  }

  /***************************************************************************
  *                        Ganess Store Home Slider
  ***************************************************************************/
  public function ganess_store_home_slider() {
    $slider_category_enable = intval(get_theme_mod('ganess_store_slider_enable',true));
    $slider_category = get_theme_mod('ganess_store_slider_category');
    $number_slider_post = get_theme_mod('slider_post_count',3);

    if($slider_category_enable == true):

    ?>
        <section id="homepageSlider" >
          <div class="homepage-slider" >
            <?php 
              $args = array(
                  'post_type'   => 'post',
                  'posts_per_page'=> $number_slider_post,
                  'category_name'  => $slider_category
              );
              $slider = new WP_Query( $args );
              
            if ( $slider->have_posts() ) { while ( $slider->have_posts() ) { $slider->the_post();
                ?>
              <section id="banner-mobile" class="grid-container full align-center-middle grid-x" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
                <div class="cell large-7 grid-container align-center">
                  <h1 class="fittext text-center"><?php the_title(); ?></h1>
                  <p class="text-center hide-for-small-only"><?php the_excerpt(); ?></p>
                  <a class="button purple large" href="<?php the_permalink(); ?>"><?php echo esc_html__('Shop Now','ganess-store'); ?></a>
                </div>
              </section>
              <?php } } wp_reset_postdata(); ?>
            </div>
          </section>

    <?php endif; 
  }



}
new Ganess_Store_Header_Hooks();
