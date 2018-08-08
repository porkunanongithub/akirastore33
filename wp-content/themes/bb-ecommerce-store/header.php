<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Ecommerce Store
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'bb-ecommerce-store' ) ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','bb-ecommerce-store'); ?></a></div>

  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="top-contact col-md-3 col-xs-12 col-sm-4">
          <?php if( get_theme_mod( 'bb_ecommerce_store_contact','' ) != '') { ?>
            <span class="call"><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_html( get_theme_mod('bb_ecommerce_store_contact',__('(518) 356-5373','bb-ecommerce-store') )); ?></span>
           <?php } ?>
        </div>
        <div class="top-contact col-md-3 col-xs-12 col-sm-4">
          <?php if( get_theme_mod( 'bb_ecommerce_store_email','' ) != '') { ?>
            <span class="email"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo esc_html( get_theme_mod('bb_ecommerce_store_email',__('support@123.com','bb-ecommerce-store')) ); ?></span>
          <?php } ?>
        </div>
        <div class="social-media col-md-6 col-sm-4 col-xs-12">
          <?php if( get_theme_mod( 'bb_ecommerce_store_youtube_url','' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'bb_ecommerce_store_youtube_url','' ) ); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'bb_ecommerce_store_facebook_url','' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'bb_ecommerce_store_facebook_url','' ) ); ?>"><i class="fab fa-facebook" aria-hidden="true"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'bb_ecommerce_store_twitter_url','' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'bb_ecommerce_store_twitter_url','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'bb_ecommerce_store_rss_url','' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'bb_ecommerce_store_rss_url','' ) ); ?>"><i class="fas fa-rss" aria-hidden="true"></i></a>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="header">
    <div class="container">
      <div class="row">
        <div class="logo col-md-3">
          <?php bb_ecommerce_store_the_custom_logo(); ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

          <?php
          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html( $description ); ?></p>
          <?php endif; ?>
        </div>      
        <div class="side_search col-md-8 col-sm-6">
        <div class="responsive_search">
        </div>
        <div class="search_form">
        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
         <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here', 'placeholder', 'bb-ecommerce-store' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'bb-ecommerce-store' ); ?>" /><button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        </div>
        </div>
        <div class="cart-btn-box col-md-1 col-6 col-sm-6">
          <div class="cart_icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
          <div class="cart_no">
            <div class="cart_txt">Total</div>
            <a class="cart-contents" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_html_e( 'View your shopping cart','bb-ecommerce-store' ); ?>"><?php if(function_exists('get_cart_total')){ echo esc_html(WC() )->cart->get_cart_total(); } ?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="nav">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-9 col-sm-9">
            <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  </div>