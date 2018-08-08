<?php
/**
 * Home Nav Menu
*/
if ( ! function_exists( 'ostore_main_nav_menu' ) ) {    
    function ostore_main_nav_menu() {
        ?>
            <nav id="primary-menu" class="primary-menu style-4 navbar navbar-default" role="navigation"  >
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <div class="container">
                    <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"><?php echo esc_html__('Toggle navigation','ostore'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php do_action("ostore_logo_and_description"); ?>
                    
                    <?php if( ostore_is_woocommerce_activated() ): ?>
                    <div class="pull-right">
                        <?php esc_html(ostore_top_wishlist()); ?>
                        <?php esc_html(ostore_top_cart()); ?>
                    </div>
                    <?php endif; ?>
                    <div class="collapse navbar-collapse pull-left" id="bs-example-navbar-collapse-1">
                        <?php wp_nav_menu( 
                            array( 'theme_location' => 'menu-1',
                                    'container' => 'ul',
                                    'menu_class'=> 'nav dropdown navbar-nav'
                                ) 
                            ); 
                        ?>
                    </div><!-- /.navbar-collapse -->
                </div><!--/.container -->
                </div>
            </nav>
        <?php   
    }
}
add_action( 'ostore_main_nav_menu', 'ostore_main_nav_menu',  2 );

/**
 * Ostore Top Header
 */
 if ( ! function_exists( 'ostore_top_header' ) ) {
	function ostore_top_header() {
		?>
			<div class="header-top">
			    <div class="container">
                <div class="row">
                    <?php 
                    $ostore_top_header_enable = get_theme_mod('ostore_top_header_enable',true);
                    if(!empty( $ostore_top_header_enable )): ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="quickinfo_main pull-left hidden-xs">
                            <ul class="quickinfo">
                                <?php
                                    $email_address    = get_theme_mod('ostore_top_header_email','addemail@gmail.com');
                                    $phone_number     = get_theme_mod('ostore_top_header_phone_no','+977 1234567890');
                                    $map_address      = get_theme_mod('ostore_top_header_address','Kathamandu , Nepal');
                                    $shop_open_time   = get_theme_mod('ostore_top_header_time','24 Hr');
                                
                                if(!empty( $email_address )) { ?>        							
                                    <li>
                                        <a href="mailto:<?php echo antispambot( $email_address ); ?>">
                                            <i class="fa fa-envelope"></i>
                                            <?php echo antispambot( $email_address ); ?>
                                        </a>
                                    </li>
                                <?php }  ?>
                                
                                <?php if(!empty( $phone_number )) { ?>        							
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <a href="tel:<?php echo esc_attr( $phone_number ); ?>">
                                            <?php echo esc_html( $phone_number ); ?>
                                        </a>
                                    </li>
                                <?php }  ?>
                                
                                <?php if(!empty( $map_address )) { ?>        							
                                    <li>        	                    	
                                        <i class="fa fa-map"></i>
                                        <?php echo esc_html( $map_address ); ?>
                                    </li>
                                <?php }  ?>
                                
                                <?php if(!empty( $shop_open_time )) { ?>        							
                                    <li>
                                        <i class="fa fa-clock-o"></i>
                                        <?php echo esc_html( $shop_open_time ); ?>
                                    </li>
                                <?php }  ?>        	                    
                            </ul>
                        </div>
                        <!-- Top Menu Section -->
                        <div class="headerlinkmenu pull-right">  
                            <div class="links">
                                <?php if (is_user_logged_in()) { ?>	
                                    <div class="myaccount">
                                        <a title="<?php esc_attr_e("My Account", 'ostore'); ?>" href="<?php the_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                            <i class="fa fa-user"></i>
                                            <span ><?php echo esc_html__('My Account', 'ostore'); ?></span>
                                        </a>
                                    </div>

                                    <div class="login">
                                        <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
                                            <i class="fa fa-lock"></i>
                                            <span ><?php echo esc_html__('Log Out', 'ostore'); ?></span>
                                        </a>
                                    </div>

                                <?php } else{ ?>

                                <div class="login">
                                        <a href="<?php the_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                            <i class="fa fa-unlock-alt"></i>
                                            <span ><?php echo esc_html__('Log In', 'ostore'); ?></span>
                                        </a>
                                    </div>
                                    <div class="login">
                                        <a href="<?php the_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                            <i class="fa fa-user"></i>
                                            <span ><?php echo esc_html__('Register', 'ostore'); ?></span>
                                    </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endif; ?>
			    </div>
		    </div>
		</div><!-- End header-top -->
		<?php
	}
}
add_action( 'ostore_top_header', 'ostore_top_header', 15 );

/**
 * Home Client Logo Slide Function Area
*/
if ( ! function_exists( 'ostore_client_logo_slider' ) ) {    
    function ostore_client_logo_slider($name) {
        if($logo_slider_enable = get_theme_mod('logo_slider_on')==true){ ?>
            <section class="our-clients">
                <div class="container">
                    <?php 
                        $logo_slider_title = get_theme_mod('logo_slider_title');
                        $logo_slider_desc = get_theme_mod('logo_slider_short_dec');
                    ?>
                    <div class="heading">  
                        <?php if(!empty($logo_slider_title)): ?><div class="hr-title ostore-tab-hr-title hr-long center"><span><?php echo esc_html($logo_slider_title); ?></span> </div><?php endif; ?>
                        <?php if(!empty($logo_slider_desc)): ?> <p class="ostore-hot-deal-desc"><?php echo esc_html($logo_slider_desc); ?></p> <?php endif; ?>
                    </div>
                <!-- End page header-->
                <div class="slider-items-products logo-slider">
                    <div id="our-clients-slider3" class="product-flexslider hidden-buttons"> 
                        <div class="slider-items slider-width-col6"> 
                        <?php  $client_logo =  get_theme_mod('logo_slide_add'); 
                            $client_logo_slider = explode(",",$client_logo,-1);
                            foreach($client_logo_slider as $client_url){
                        ?>
                    <!-- Item -->
                    <div class="item wow zoomIn"><img src="<?php echo esc_url($client_url); ?>" class="grayscale"> </div>
                    <!-- End Item --> 
                    
                    <?php } ?>
                    </div>
                </div>
                </div>
            </div>
            </section>
        <?php }  
    }
}
add_action( 'ostore_client_logo', 'ostore_client_logo_slider', 10, 2 );

/**
 * Add Top Cart Header
*/
if ( ! function_exists( 'ostore_logo_description' ) ) {    
    function ostore_logo_description() {
        ?>
            <!-- Header Logo -->
            <div class="logo site-title pull-left">
                <?php the_custom_logo(); ?>
            <?php if (  display_header_text() ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php
                $description = get_bloginfo( 'description', 'display' ); ?>
                <p class="site-description"><?php echo esc_html($description);  ?></p>
            <?php endif; ?>
            </div>
            <!-- End Header Logo --> 
            <?php
    }
}
add_action( 'ostore_logo_and_description', 'ostore_logo_description');



/**
*   Home Slider
*/
if ( ! function_exists( 'ostore_home_slider' ) ) {    
    function ostore_home_slider($name) {
        /*
        * Home page slider
        */
        if( get_theme_mod('ostore_slider_enable', true) ) : 
            $slider_category = get_theme_mod('ostore_slider_category', null);
            $ostore_number_of_slider = get_theme_mod('ostore_number_of_slider',3);

            if( $slider_category != null ) :
            $args = array(
                'post_type'   => 'post',
                'post_count'  => -1,
                'category_name'  => $slider_category,
                'posts_per_page' =>  $ostore_number_of_slider
            );
            $slider = new WP_Query( $args );
        
        $slider_style = get_theme_mod('ostore_slider_style','default');
            
        ?>
        <div class="slider">
            <div class="row" style="margin:0px !important;">
            <!-- <div class="col-md-12"> -->
                <?php if( $slider_style == "left" ){ 
                    do_action('ostore_slider_category'); 
                }  ?>
            </div>
            </div>
            <!--End cat -->
            
            <?php if($slider_style=='default'){ ?>
                <div class="col-md-12 fullslider" style="margin:0px !important;">
            <?php }else {?>
                <div class="col-md-9 slide-sidebar">
            <?php }?>
                <div class="flexslider ma-nivoslider ">
                <div id="os-inivoslider-banner" class="slides ">
                    <?php 
                    if ( $slider->have_posts() ) {
                        while ( $slider->have_posts() ) {
                        $slider->the_post();
                        if ( has_post_thumbnail() && $slider_style == 'default'):
                            the_post_thumbnail('ostore-slider-image', array( 'class' => 'img-responsive slider-image', 'title' => '#banner7-caption'. get_the_ID() ));
                        elseif(has_post_thumbnail() && ($slider_style=='left' OR $slider_style=='right' )):
                            the_post_thumbnail('ostore-slider-widget', array( 'class' => 'img-responsive slider-widget', 'title' => '#banner7-caption'. get_the_ID() ));
                        endif;     
                    ?>
                    <?php } } wp_reset_postdata();  ?>
                </div>
                <?php
                if ( $slider->have_posts() ) {
                        while ( $slider->have_posts() ) {
                        $slider->the_post();
                        if ( has_post_thumbnail()):
                        ?>
                        <div id="banner7-caption<?php echo get_the_ID(); ?>" class="banner7-caption nivo-html-caption nivo-caption">
                            <div class="timethai"></div>
                            <div class="banner7-content slider-<?php echo get_the_ID(); ?>">
                            <div class="slide-caption">
                            <div class="caption-content">
                                    <h2 class="animated fadeInDown"><?php the_title(); ?></h2>
                                    <span class="animated fadeInDown hidden-xs"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 10)); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-blue btn-effect"><?php echo esc_html__('View Collection','ostore'); ?></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php endif;
                        }} ?>
                <!-- /.flexslider --> 
                </div>
                </div>
    
            <!-- <div class="col-md-12"> -->
            <?php if( $slider_style == "right" ){ 
                do_action('ostore_slider_category'); 
            } ?>
            </div>
            </div>
            <!--End cat -->
                <!-- </div> -->
            </div>
        </div>
        
        <?php  endif ; 
        endif;    
    }
}
add_action( 'ostore_main_slider', 'ostore_home_slider', 10, 2 );

/**
 * Home Page HLP Product Hot Deal Product
*/
if ( ! function_exists( 'ostore_hlp_hot_deal' ) ) {    
    function ostore_hlp_hot_deal($hot_deal_product_args,$categories_cat_id) {
        $category_name = get_cat_name( $categories_cat_id );
        ?>
        <div class="col-md-4 col-sm-6 col-lg-4">
        <div <?php post_class('panel_product ostore-hlp-panel-products'); ?> >
            <h2 class="ostore_hlp_title"><?php echo esc_html($category_name); ?></h2>
        
            <div class="ostore-slider-items-products">                        
                <div id="hot-deals-slider" class="product-flexslider hidden-buttons">                        
                <div class="slider-items slider-width-col3"> 
                
                <?php
                    $hot_deal_query = new WP_Query( $hot_deal_product_args );
                    if( $hot_deal_query->have_posts() ) {  while( $hot_deal_query->have_posts() ) { $hot_deal_query->the_post();
                ?>
                <div class="product-item">
                        <div class="item-inner fadeInUp">
                        <div class="product-thumbnail">
                            <div class="icon-hot-label hot-left"><?php echo esc_html__('Hot','ostore'); ?></div>
                            <div class="pr-img-area"> <a href="<?php the_permalink(); ?>">
                            <figure>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'shop_catalog', array( 'class' => 'first-img' ) ); ?> 
                                </a>
                            </figure>
                            </a>
                            <div class="pr-button">
                                <!-- wishlist -->
                                <?php if(function_exists( 'ostore_wishlist_products' )): ?>
                                    <div class="mt-button add_to_wishlist">
                                        <?php ostore_wishlist_products(); ?> 
                                    </div>
                                <?php endif; ?>

                                <!-- compare -->
                                <?php if(function_exists( 'ostore_add_compare_link' )): ?>
                                    <div class="mt-button add_to_compare"> 
                                        <?php ostore_add_compare_link(); ?>                                   
                                    </div>
                                <?php endif; ?>

                                <!-- quick view -->
                                <?php if(function_exists( 'ostore_quickview' )): ?>
                                    <div class="mt-button quick-view"> 
                                        <?php ostore_quickview(); ?>
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                            <div class="add-to-cart">
                            <button type="button" class="add-to-cart-mt"> <span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </button>
                            </div>
                            
                            </div>
                        </div><div class="ostore-hlp-box-timer">
                            <?php
                                $product_id = get_the_ID();
                                $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                $date = date_create($sale_price_dates_to);
                                $new_date = date_format($date,"Y/m/d H:i");
                            //if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                        ?>
                                <div class="ostore-hlp-box-timer pcountdown-cnt-list-slider">
                                <div class="countbox_1 ostore-hlp-timer-grid  countdown_<?php echo esc_attr($product_id); ?>">
                                    <div class="day box-time-date"><span class="days"><?php esc_html_e('00','ostore'); ?></span><?php echo esc_html__('Days','ostore'); ?></div>
                                    <div class="hour box-time-date"><span class="hours"><?php esc_html_e('00','ostore'); ?></span><?php echo esc_html__('Hours','ostore'); ?></div>
                                    <div class="min box-time-date"><span class="minutes"><?php esc_html_e('00','ostore'); ?></span><?php echo esc_html__('Mins','ostore'); ?></div>
                                    <div class="sec box-time-date"><span class="seconds"><?php esc_html_e('00','ostore'); ?></span><?php echo esc_html__('Secs','ostore'); ?></div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                    setTimeout(function(){
                                        jQuery(".countdown_<?php echo intval($product_id); ?>").countdown({
                                            date: "<?php echo esc_attr($new_date); ?>",
                                            offset: -8,
                                            day: "Day",
                                            days: "Days"
                                        }, function () {
                                            console.log( "done")
                                        });
                                    })
                                    
                                }, 900);
                            </script>
                        <?php //} } ?>
                        </div>
                        <div class="ostore-hlp-item-info">
                        
                            <div class="info-inner">
                            <div class="ostore-item-title"> <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php  the_title(); ?></a> </div>
                            <div class="item-content">
                                <div class="rating">
                                    <span><?php  ostore_get_star_rating()?></span>  
                                </div>
                                <div class="item-price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                <?php }} ?> 
                </div>
                </div>
            </div>
            </div>
        </div><!-- End of Hot Deal Product -->
    <?php }
}
add_action( 'ostore_hlp_hot_deal_product', 'ostore_hlp_hot_deal',10,2 );

/**
 * Home Slider Left and Right Category Show
*/
if ( ! function_exists( 'ostore_home_slider_cat' ) ) {    
    function ostore_home_slider_cat($name) {
        ?>
        <!--Start Cat-->
        <div class="col-md-3 col-sm-12 " style="margin:0px !important;">
        <div class="row">
            <?php
                $slider_cat_1_name = get_theme_mod('ostore_woo_category_1');
                if( intval($slider_cat_1_name) > 0){
                    $category = get_term_by( 'slug', $slider_cat_1_name, 'product_cat' );
                    $slider_1_cat_id = $category->term_id;
                    $thumbnail_id = get_woocommerce_term_meta( $slider_1_cat_id, 'thumbnail_id', true );
                    $slider_2_image = wp_get_attachment_url($thumbnail_id);
                    $slider_cat_1_url = get_term_link($slider_1_cat_id, 'product_cat');
                }else{
                    $category = null;
                    $slider_cat_1_url = "";
                    $slider_2_image = "//via.placeholder.com/450x250";
                }
            ?>
                
                <div class="col-md-12 col-sm-6" >
                    <a href="<?php echo esc_url($slider_cat_1_url);  ?>" class="ostore-bottom-banner-img">
                        <div class="overimg"> 
                        <img src="<?php echo esc_url($slider_2_image);   ?>" alt="" style="display:block;overflow:hidden; " />
                        </div>
                        <span class="ostore-banner-overly"></span>
                        <?php if( $category ): ?>
                            <div class="bottom-img-info">
                                <h3><?php echo wp_kses_post($category->name); ?></h3>
                                <h6><?php echo wp_kses_post(substr(($category->description),0,40)); ?></h6>
                                <span class="shop-now-btn"><?php echo esc_html__('View more','ostore'); ?></span> 
                            </div>
                        <?php endif; ?>
                    </a>
                </div>

            <!-- Second Category -->
                <?php
                    $slider_cat_2_name = get_theme_mod('ostore_woo_category_2');
                    if( intval($slider_cat_2_name) > 0){
                        $slider_category_2 = get_term_by( 'slug', $slider_cat_2_name, 'product_cat' );
                        $slider_2_cat_id = $slider_category_2->term_id;
                        $thumbnail_id = get_woocommerce_term_meta( $slider_2_cat_id, 'thumbnail_id', true );
                        $slider_2_image = wp_get_attachment_url($thumbnail_id);
                        $slider_cat_2_url = get_term_link($slider_2_cat_id, 'product_cat');
                    }else{
                        $slider_category_2 = null;
                        $slider_cat_2_url = "";
                        $slider_2_image =  "//via.placeholder.com/450x250";

                    }
                ?>
                <div class="col-md-12 col-sm-6 " >
                    <a href="<?php echo esc_url($slider_cat_2_url);  ?>" class="ostore-bottom-banner-img">
                        <div class="overimg"> 
                        <img src="<?php echo esc_url($slider_2_image);   ?>" class="slider-cat-2-img" alt="" style=" " />
                        </div>
                        <span class="ostore-banner-overly"></span>
                        <?php if( $slider_category_2) : ?>
                            <div class="bottom-img-info">
                                <h3><?php echo wp_kses_post($slider_category_2->name); ?></h3>
                                <h6><?php echo wp_kses_post(substr(($slider_category_2->description),0,40)); ?></h6>
                                <span class="shop-now-btn"><?php echo esc_html__('View more','ostore'); ?></span> 
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
        <?php 
    }
}
add_action( 'ostore_slider_category', 'ostore_home_slider_cat' );


/**
 * Home Slider Left and Right Category Show
*/
if ( ! function_exists( 'ostore_recent_blog_slider' ) ) {    
    function ostore_recent_blog_slider() {
        ?>
        <!-- Related Posts -->
        <div class="single-box">
        <h2><?php echo esc_html__('Releated Post','ostore'); ?></h2>
        <div class="slider-items-products">
            <div id="related-posts" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 fadeInUp">
            <?php 
                $args = array( 'post_status'=>'publish', 'numberposts' => '5', 'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => 'post-format-aside',
                            'operator' => 'NOT IN'
                        ), 
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => 'post-format-image',
                            'operator' => 'NOT IN'
                        )
                ) );
                $recent_posts = wp_get_recent_posts( $args );
                foreach( $recent_posts as $recent ){
            ?>
            <div class="product-item">
            <article class="entry">
                <div class="entry-thumb image-hover2"> <a href="<?php echo esc_url(get_permalink(intval($recent['ID']))); ?>"> <img src="<?php echo esc_url(get_the_post_thumbnail_url(intval($recent["ID"]))); ?>" > </a> </div>
                <div class="entry-info">
                <h3 class="entry-title"><a href="<?php echo esc_url(get_permalink(intval($recent['ID']))); ?>"><?php echo esc_html($recent["post_title"]); ?></a></h3>
                <div class="entry-meta-data"> 
                    <span class="comment-count">
                        <a href="<?php echo esc_url(get_comments_link(intval($recent['ID'])) ); ?>"> 
                        <i class="fa fa-comment-o">&nbsp;</i>
                            <?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'ostore'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?>
                        </a>
                    </span>
                    <span class="date"> <i class="fa fa-calendar">&nbsp;</i><?php  $cpost = get_post(intval($recent["ID"])); echo esc_html(date(get_option('date_format'), strtotime($cpost->post_date)));  ?></span>
                </div>
                <div class="ostore-recent-entry-more"> <a href="<?php echo esc_url(get_permalink(intval($recent['ID']))); ?>" class="ostore-recent-btn"><?php echo esc_html__('Read more','ostore'); ?></a> </div>
                </div>
            </article>
            </div>
                <?php } 
                    wp_reset_query();
                ?>
                
            </div>
            </div>
        </div>
        </div>
        <!-- ./Related Posts --> 
    <?php }
    }
    add_action( 'ostore_recent_blog', 'ostore_recent_blog_slider' );


/**
 * Footer Copyright section
*/
if ( ! function_exists( 'ostore_footer_copyright' ) ) {    
    function ostore_footer_copyright() {
    ?>
    <div class="col-sm-5 col-xs-12 coppyright">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ostore' ) ); ?>"><?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'ostore' ), 'WordPress' );
            ?></a>
            <span class="sep"> | </span><a href="<?php echo esc_url('www.themerelic.com'); ?>">
            <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf( esc_html__( 'Theme: %1$s by %2$s.', 'ostore' ), 'Ostore', 'ThemeRelic' );
            ?>
        </a>
    </div>
    <?php
    }
}
add_action( 'ostore_footer_copyright_section', 'ostore_footer_copyright');



/**
 * Ostore  Services Area
 */
if ( ! function_exists( 'ostore_services_area' ) ) {
	function ostore_services_area( $service_icon = null, $service_title = null, $service_desc = null ) {	
	    ?>
		<div class="col-sm-4 ostore-service-boxw " >
        <div class="ostore-service-box ">
        <div class="front">
            <div class="ostore-service-icon"><i class="<?php echo esc_attr($service_icon); ?>"></i></div>
            <div class="ostore-service-icon-info">
            <h5><?php echo esc_attr($service_title); ?></h5>
            <div class="hidden-sm "><p><?php echo wp_kses_post($service_desc); ?></p></div>
            </div>
        </div>
        <div class="back">
            <div class="ostore-service-icon"><i class="<?php echo esc_attr($service_icon); ?>"></i></div>
            <div class="ostore-service-icon-info">
            <h5><?php echo esc_attr($service_title); ?></h5>
            <div class="hidden-sm "><p><?php echo wp_kses_post($service_desc); ?></p></div>
            </div>
        </div>
        </div>
    </div>
	<?php 
	}
}

/**
 * Ostore  Social Links
 */
if ( ! function_exists( 'ostore_social_links' ) ) {
	function ostore_social_links( $service_icon = null, $service_title = null, $service_desc = null ) {	
    $facebook_url = get_theme_mod('facebook_url','https://www.facebook.com/');
    $googleplus_url = get_theme_mod('google_plus','https://www.plus.google.com/');
    $twitter_url = get_theme_mod('twitter_url','https://www.twitter.com');
    $rss_url = get_theme_mod('rss_url','https://www.rss.com');
    $linkedin_url = get_theme_mod('linkedin_url','https://www.linkedin.com');
    $instagram = get_theme_mod('instagram_url','https://www.instagram.com');
    ?>
    <ul class="inline-mode">
        <?php if(!empty( $facebook_url) ) { ?><li class="social-network fb"><a title="<?php esc_attr('Connect us on Facebook','ostore') ?>" target="_blank" href="<?php echo esc_url($facebook_url);  ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
        <?php if(!empty( $googleplus_url) ) { ?><li class="social-network googleplus"><a title="<?php esc_attr('Connect us on Google+','ostore'); ?>" target="_blank" href="<?php echo esc_url($googleplus_url); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
        <?php if(!empty( $twitter_url) ) { ?><li class="social-network tw"><a title="<?php esc_attr('Connect us on Twitter','ostore'); ?>" target="_blank" href="<?php echo esc_url($twitter_url);  ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
        <?php if(!empty( $rss_url) ) { ?><li class="social-network rss"><a title="<?php esc_attr('Connect us on Instagram','ostore'); ?>" target="_blank" href="<?php echo esc_url($rss_url);  ?>"><i class="fa fa-rss"></i></a></li><?php } ?>
        <?php if(!empty( $linkedin_url) ) { ?><li class="social-network linkedin"><a title="<?php esc_attr('Connect us on Linkedin','ostore'); ?>" target="_blank" href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
        <?php if(!empty( $instagram) ) { ?><li class="social-network instagram"><a title="<?php esc_attr('Connect us on Instagram','ostore'); ?>" target="_blank" href="<?php echo esc_url($instagram);  ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
    </ul>    
	<?php 
	}
}
add_action( 'ostore_footer_social_links', 'ostore_social_links');

/**
 * Ostore  Payment Logo
 */
 if ( ! function_exists( 'ostore_payment_logo' ) ) {
	function ostore_payment_logo( $service_icon = null, $service_title = null, $service_desc = null ) {	
    $payment_enable = get_theme_mod('payment_enable');
    
    if($payment_enable==1): ?>
        <div class=" col-sm-3 col-xs-12">
        <div class="payment">
            <ul>
            <?php  
            $payment_logo =  get_theme_mod('payment_logo_add'); 
            $payment_logo_image = explode(",",$payment_logo,-1);
            foreach($payment_logo_image as $payment_logo_url){
            ?>
            <li><img  src="<?php echo esc_url($payment_logo_url);  ?>" ></li>
            <?php } ?>
            </ul>
        </div>
        </div>
    <?php endif;
	}
}
add_action( 'ostore_footer_payment_logo', 'ostore_payment_logo');


/**
*  Ostore Title Section
*/
if ( ! function_exists( 'ostore_title' ) ) {    
    function ostore_title($title,$short_desc) {
        if(!empty($title) OR !empty($short_desc)):
        ?>
        <div class="title-bg">
            <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                <?php if(!empty($title)): ?><li class="active"><a href="javascript:void(0);"><?php echo esc_html($title); ?></a></li><?php endif; ?>
            </ul>
            <?php if(!empty($short_desc)): ?><p class="pull-right"><?php echo esc_html($short_desc); ?></p><?php endif; ?>
        </div>
        <?php    endif; 
    }
}
add_action( 'ostore_home_title', 'ostore_title',  3 );

/**
 * Ostore  Tab Layout
 */
if ( ! function_exists( 'ostore_tab_layout_option' ) ) {
	function ostore_tab_layout_option( $tab_product_default,$tab_multiple_category_id,$tab_product_multiple_select) {	
    
        $woo_defaut_cat = array(
                'feature_product' => __("Feature Product", 'ostore'),
                'latest_product' =>  __("Latest Product", 'ostore'),
                'onsale_product'  =>  __("Onsale Product", 'ostore'),
                'upsale_product'  =>  __("Upsale Product", 'ostore')
            );
        ?>
        <div class="title-bg">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all new_cat">
        <?php 
            $count = 1;
            if($tab_product_default == 'cat' ){
                if(!empty($tab_multiple_category_id)){
                foreach($tab_multiple_category_id as $tab_key =>  $tab_cat_id){ 
                $term = get_term_by( 'id', $tab_key, 'product_cat');

                if($term == null){
                    $term = (object) array('name'=>'default','slug'=>'');
                }
            ?>
            <li class="<?php if($count == 1){ ?>active <?php }$count++; ?>" cat_link ="<?php echo esc_attr(get_category_link($tab_key)); ?>" ><a  href="#<?php echo esc_attr( $term->slug ); ?>" data-toggle="tab" aria-expanded="false"><?php echo esc_attr( $term->name ); ?></a></li>
            
            <?php 

            $count++; }} 
                }else{
                foreach($tab_product_multiple_select as $tab_key =>  $tab_cat_id){ 
                $term = get_term_by( 'id', $tab_key, 'product_cat');
                if($term == null){
                    $term = (object) array('name'=>'default','slug'=>'');
                }
                ?> 
                <li <?php if($count == 1){ ?> class="active"<?php }  ?>   ><a href="#<?php echo esc_attr( $tab_cat_id ); ?>" data-toggle="tab" aria-expanded="false"><?php echo esc_html($woo_defaut_cat[$tab_cat_id]);  ?></a></li>
            <?php

            $count++; }} ?>
        </ul>
        </div>
    <?php 
	}
}
add_action( 'ostore_tab_diff_layout', 'ostore_tab_layout_option', 10, 4);

//sidebar layout Class
if (!function_exists('ostore_main_class')) {
    function ostore_main_class() {
        $ostore_page_layout = ostore_get_layout();
        
        //Condtion for class
        if( $ostore_page_layout == 'full-width' ){
        	$ostore_main_class = 'col-xs-12 col-md-12';
        }elseif($ostore_page_layout == 'both-sidebar'){
        	$ostore_main_class = 'col-xs-12 col-md-6';
        }elseif( get_theme_mod('archive_page_layout_option','right-sidebar') == 'both-sidebar'){
        	$ostore_main_class = 'center_column col-xs-12 col-sm-12 col-md-6';
        }elseif( get_theme_mod('archive_page_layout_option','right-sidebar') == 'full-width'){
        	$ostore_main_class = 'center_column col-xs-12 col-sm-12 col-md-12';
        }else{
        	$ostore_main_class = 'col-xs-12 col-md-9';
        }
        
        //Return the Class 
        return $ostore_main_class;
        
    }
}


/**************************************************************************
 *                        Ostore Advance Search Box
***************************************************************************/
if (!function_exists('ostore_header_search_form')) {
    function ostore_header_search_form() { 

        if( get_theme_mod('ostore_search_box_enable',true) == true ):
        ?>
        
        <form class="main-form clearfix" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search Products', 'ostore'); ?>">
            <?php if (class_exists('WooCommerce')) : ?>
                <?php 
                    if( isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']) ){
                        $optsetlect = sanitize_text_field( wp_unslash( $_REQUEST['product_cat'] ) );
                    }
                    else{
                    $optsetlect = 0;  
                    }
                    $args = array(
                                'show_option_all' => esc_html__( 'Categories', 'ostore' ),
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
            <button type="submit" title="<?php esc_attr_e('Search', 'ostore'); ?>" class="search-btn-bg"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        
        <?php
        endif;
    }
}
add_action( 'header_search_form','ostore_header_search_form' );







/** 1.Breadcrumb Section Functions Hear */

if ( ! function_exists( 'ostore_breadcrumb' ) ) {
    function ostore_breadcrumb() {
        
        //Enable Breadcrumb Section 
        if( get_theme_mod('ostore_breadcrumb_enable',true ) == true  ){
            global $post;

            $ostore_breadcrumb_separator = wp_kses_post( '<span class="separator"> / </span>' );
            echo '<section class="breadcrumb"><div class="container"><div class="row"><div class="col-md-12"><div class="breadcrumb_wrap">';
            if (!is_home()) {
                echo '<div class="breadcrumb-section">';
                
                echo '<i class="fa fa-home" aria-hidden="true"></i><a href="';
                echo esc_url( home_url( '/' ) );
                echo '">';
                echo esc_html__('Home', 'ostore');
                echo '</a>'.$ostore_breadcrumb_separator ;
                if ( is_category() || is_single()) {
                    the_category( $ostore_breadcrumb_separator );
                    if (is_single()) {
                        echo ''.$ostore_breadcrumb_separator;
                        the_title();
                    }
                } elseif ( is_page() ) {
                    if($post->post_parent){
                        $title = get_the_title();
                        
                        echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
                    } else {
                        echo '<span> '. esc_html(get_the_title()).'</span>';
                    }
                }
                elseif (is_tag()) {single_tag_title();}
                elseif (is_day()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'ostore'), get_the_time('F jS, Y')); echo '</span>';}
                elseif (is_month()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'ostore'), get_the_time('F, Y')); echo '</span>';}
                elseif (is_year()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'ostore'), get_the_time('Y')); echo '</span>';}
                elseif (is_author()) {echo "<span>" . esc_html__('Author Archive', 'ostore'); echo '</span>';}
                elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>" . esc_html__('Blog Archives', 'ostore'); echo '</span>';}
                elseif (is_search()) {echo "<span>" . esc_html__('Search Results', 'ostore'); echo '</span>';}
                
                echo '</div>';
            } else {
                echo '<div class="breadcrumbs-section">';
                
                echo '<a href="';
                echo esc_url( home_url( '/' ) );
                echo '">';
                echo esc_html__('Home', 'ostore');
                echo '</a>'.$ostore_breadcrumb_separator;
                
                echo esc_html__('Blog', 'ostore');
                
                
                echo '</div>';
            }

            echo "</div></div></div></div></section>";
        }
    }

}
