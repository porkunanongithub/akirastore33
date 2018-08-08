<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ganess_Store
 */

global $Ganess_Store_Woocommerce;
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> dir="ltr">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class('woocommerce hfeed'); ?>>
    <div class="off-canvas position-right" id="full-menu" data-off-canvas>
    <?php
    //for nav class
      if( get_theme_mod('ganess_store_header_search_box_enable',true) == true ){
        $nav_menu_class = 'large-12 ';
      }else{
        $nav_menu_class = 'large-9 without-search';
      }
    ?>
      <div id="main-menu" class="cell <?php echo esc_attr( $nav_menu_class ); ?> grid-x align-right align-top large-order-4 main-navigation">
        <?php wp_nav_menu( 
              array( 'theme_location' => 'menu-1',
                      'container' => 'ul',
                      'menu_class'=> 'menu align-right align-middle'
                  ) 
              ); 
          ?>
      </div>
    </div>
    <div class="off-canvas-content" data-off-canvas-content>
      <section id="top"></section>
      <header >
        <?php do_action('ganess_store_before_header'); ?>
        <div id="ganess-store-header-section" class="grid-container full second-bar">
          <div class="grid-container grid-x ">
            <?php do_action('ganess_store_header_logo_section',1); ?>
            <div class="header-right-container grid-x medium-9 small-12">
                <?php 
                    do_action('ganess_store_before_nav');
                    if(ganess_store_is_woocommerce_activated()){
                        $Ganess_Store_Woocommerce->ganess_store_woocommerce_header_cart();
                    }
                ?>
            </div>
          </div>
        </div>
        <div class="grid-container grid-x third-bar"></div>
    </header>
