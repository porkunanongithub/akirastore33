<?php
/*This file is part of simu-store, sornacommerce child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function simu_store_enqueue_child_styles() {
	
	$parent_style = 'sornacommerce-style'; 
	
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
	
	wp_enqueue_style( 'rd-navbar-css', get_theme_file_uri( '/assets/rd-navbar/css/rd-navbar.css' ), '2.1.6' );
	wp_enqueue_style( 'simu-Material-icon', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
	wp_enqueue_style( 'simu-Lato', 'https://fonts.googleapis.com/css?family=Lato:400,700' );
	
	
	wp_enqueue_style( 
		'simu-store', 
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version') );
		
		
	/* PLUGIN JS */
	wp_enqueue_script( 'jquery-rd-navbar', get_theme_file_uri( '/assets/rd-navbar/js/jquery.rd-navbar.js' ), 0, '', true );
	
	
	/*THEME JS */
	wp_enqueue_script( 'simu-js', get_theme_file_uri( '/assets/js/simu.js' ),0, '', true );
	
	
	}
add_action( 'wp_enqueue_scripts', 'simu_store_enqueue_child_styles' );


require get_theme_file_path() . '/vendor/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';


add_action( 'init', 'simu_store_remove_action');
function simu_store_remove_action() {
	
 remove_action( 'sornacommerce_site_header_block','sornacommerce_header_block',11 );
 remove_action( 'sornacommerce_site_footer_block', 'sornacommerce_site_footer_block' );
}


add_action( 'sornacommerce_site_header_block','simu_store_site_header_block',11 );
if( !function_exists('simu_store_site_header_block') ) :
	function simu_store_site_header_block() {
	 ?>
     <div class="header-main hamzahshop-custom-header">
<div class="container">
<div class="header-content">
        <div class="row" >
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="logo"> 
            <?php
            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                      the_custom_logo();
            }else{
            ?>
            	 <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
             
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                     <p class="site-description"><?php echo esc_attr($description); ?></p>
                <?php endif; ?>
                
             <?php }?>   
        
            
             </div>
          </div>
         
         <?php do_action('simu_store_custom_product_search');?>
         
         
        </div>


</div>    
</div>
</div>
     <?php
	}
endif;


if ( !function_exists('simu_store_custom_product_search') ):
	
	/**
	 * simu_store_custom_product_search.
	 *
	 * @since 1.0.0
	 */
	 
	function simu_store_custom_product_search(){	
	?>
	
	<?php if ( class_exists( 'WooCommerce' ) ) :?>
	
    
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div id="search-category">
            <form class="search-box" action="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" method="post">
              <div class="search-categories">
                <div class="search-cat">
                  <?php 
            $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'show_count' => '0',
            'pad_counts' => '0',
            'hierarchical' => '1',
            'title_li' => '',
            'hide_empty' => '0',
            
            );
            $all_categories = get_categories( $args );
            ?>
                  <select class="category-items" name="category">
                    <option value="0">
                    <?php esc_html_e('All Categories','simu-store') ?>
                    </option>
                    <?php foreach( $all_categories as $category ) { ?>
                    <option value="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->cat_name ); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <input type="search" name="s" id="text-search" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search here...','simu-store') ?>" />
              <button id="btn-search-category" type="submit"> <i class="icon-search"></i> </button>
              <input type="hidden" name="post_type" value="product" />
            </form>
          </div>
        </div>

    
	<?php endif;?>
  
	<?php
	}
	add_action( 'simu_store_custom_product_search', 'simu_store_custom_product_search');
endif;


add_action( 'sornacommerce_site_header_block','simu_store_site_nav_bar', 20);

if( !function_exists('simu_store_site_nav_bar') ):
	function simu_store_site_nav_bar($test){
	?>
      <!-- RD Navbar -->
        <div class="rd-navbar-wrap">
            <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="50px" data-lg-stick-up-offset="150px" class="rd-navbar">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                
                <div class="rd-navbar-outer">
                    <div class="rd-navbar-inner">

                        <div class="rd-navbar-subpanel">
                            <div class="rd-navbar-nav-wrap">
                                <!-- RD Navbar Nav -->
							<?php
                            wp_nav_menu( array(
                                'theme_location'    => 'primary',
                                'depth'             => 3,
                                'menu_class'        => 'rd-navbar-nav',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ) );
                            ?>
                                <!-- END RD Navbar Nav -->
                            </div>
                            
							<?php if ( class_exists( 'WooCommerce' ) ) :?>
                            <!-- RD Navbar Search Toggle -->
                            <div class="rd-navbar-cart-wrap">
                            <div class="rd-navbar-cart-floating">
                                <button class="rd-navbar-cart-toggle"
                                        data-rd-navbar-toggle=".rd-navbar-cart, .rd-navbar-cart-floating">
                                    <span></span>
                                </button>
                            </div>
                            <div class="rd-navbar-cart">
                            <?php wc_get_template_part( 'simu-mini-cart' );?>
                                
                            </div>
                            </div>
                            <!-- END RD Navbar Search Toggle -->
                            <?php endif;?>
                            
                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>
<!-- END RD Navbar -->
    <?php	
	}
endif;


add_action( 'sornacommerce_site_footer_block', 'simu_store_site_footer_block' );


if ( ! function_exists( 'simu_store_site_footer_block' ) ) :

	/**
	 * simu_store_site_footer_block.
	 *
	 * @since 1.0.0
	 */
	function simu_store_site_footer_block() {
	  ?>
      
        <footer id="footer">
            <section class="footer footer-margin">
                <div class="container">
                    <?php if ( is_active_sidebar( 'footer' ) ) : ?>
                        <div class="row">
                            <?php dynamic_sidebar( 'footer' ); ?>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="center">
                                <p class="footer"><?php
								 $options = get_theme_mod( 'sornacommerce_theme_options' );
								 if( isset( $options['footer']['copyright'] ) ){
								 echo esc_html( $options['footer']['copyright'] );
								 
								 }?>  <br/>
                          
                         
                            <a href="<?php /* translators:straing */ echo esc_url(  'https://wordpress.org/' ); ?>"><?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s', 'simu-store' ),esc_html__( 'WordPress', 'simu-store' ) ); ?></a>
                            | 
                        <?php
                        printf(  /* translators: %s: edatastyle */ esc_html__( 'Theme: %1$s by %2$s.', 'simu-store' ), 'Simu Store', '<a href="' . esc_url('https://edatastyle.com' ) . '" target="_blank">' . esc_html__( 'eDataStyle', 'simu-store' ) . '</a>' ); ?>
                        </p>
                        <!-- /Copyright -->
        
                            </div>
                           <?php if( get_theme_mod( 'sornacommerce_theme_options_socialfooter','0') == 1 ):?>
                            <ul class="social-link">
                               <?php $social_link = get_theme_mod( 'sornacommerce_theme_options' );?>
                          <?php foreach ($social_link['social'] as $key => $link):
						  	if( $link != ""):
							?>
                            <li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_html($key);?>" target="_blank"></a></li>
                          <?php endif; endforeach;?>
                            </ul>
                            <?php endif;?>
                            
                        </div>
                    </div>
                </div>
            </section>
         
        </footer>
        
        <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

      <?php

	}

endif;