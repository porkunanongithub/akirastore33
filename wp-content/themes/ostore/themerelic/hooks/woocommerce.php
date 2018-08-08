<?php
/**
 * Woo Commerce Add Content Primary Div Function
**/
/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function ostore_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ostore_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function ostore_woocommerce_scripts() {
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'ostore-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'ostore_woocommerce_scripts' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('ostore_woocommerce_output_content_wrapper')) {
    function ostore_woocommerce_output_content_wrapper(){ ?>
    <div class="main-container">
        <div class="container">
        <div class="row">
            <?php 
                $ostore_woocommerce_page_layout_option = get_theme_mod('ostore_woocommerce_page_layout_option','right-sidebar');   
                //Ostore Sidebar Layout 
                if ( $ostore_woocommerce_page_layout_option  == 'left-sidebar' ) : 
                    get_sidebar('woocommerce');
                endif;

                //Condtion hear
                if( $ostore_woocommerce_page_layout_option == 'full-width' ){
                    $woocommerce_class = 'col-main col-md-12 col-sm-12';
                }else{
                    $woocommerce_class = 'col-main col-md-9 col-sm-12';
                }
            ?>
            <div class="<?php echo esc_attr($woocommerce_class); ?>">
            <?php   }
        }
        add_action( 'woocommerce_before_main_content', 'ostore_woocommerce_output_content_wrapper', 10 );


        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        if (!function_exists('ostore_woocommerce_output_content_wrapper_end')) {
            function ostore_woocommerce_output_content_wrapper_end(){ 
            $ostore_woocommerce_page_layout_option = get_theme_mod('ostore_woocommerce_page_layout_option','right-sidebar');        
            ?>
        </div>
        
        <?php 
            //Ostore Sidebar Layout 
            if ( $ostore_woocommerce_page_layout_option  == 'right-sidebar' ) : 
                get_sidebar('woocommerce');
            endif;
        ?>
    </div><!-- row -->
</div><!-- container -->
</div><!-- main-container -->
<?php   }
}
add_action( 'woocommerce_after_main_content', 'ostore_woocommerce_output_content_wrapper_end', 10 );


/**
 * WooCommerce Manage Product Div Structure
**/
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


if (!function_exists('ostore_woocommerce_before_shop_loop_item')) {
    function ostore_woocommerce_before_shop_loop_item(){ ?>
    <div class="product-item">
        <div class="item-inner">
           <div class="product-thumbnail">
                <?php 
                global $post, $product; 

                //Featured Products Display
                if( $product->is_featured() ){
                    echo '<div class="icon-sale-label featured sale-right">Featured</div>';
                }

                if ( $product->is_on_sale() ) :
                    echo apply_filters( 'woocommerce_sale_flash', '<div class="icon-sale-label sale-left">' . __( 'Sale', 'ostore' ) . '</div>', $post, $product ); ?>
                <?php endif; ?>
                <?php
                global $product_label_custom;
                if ($product_label_custom != ''){
                    echo '<div class="icon-new-label new-right">'.$product_label_custom.'</div>';
                }
                ?>
            
                <div class="pr-img-area">
                    <figure>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'woocommerce_thumbnail' ); ?> 
                        </a>
                    </figure>
                    <span type="button" class="add-to-cart-mt"> <span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </span>

                </div>
            
                <div class="pr-info-area">
                   <div class="pr-button">
                        <?php if(function_exists( 'ostore_wishlist_products' )): ?>
                            <div class="mt-button add_to_wishlist">
                                <?php ostore_wishlist_products();  ?> 
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
                                <?php  ostore_quickview();  ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="info-wrap">
            <div class="item-info clearfix">
                <div class="info-inner">
                    <div class="item-title"> 
                        <h3>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                    </div>

                    <div class="item-content">

                      <div class="item-price"><?php woocommerce_template_loop_price(); ?></div>
                </div>
            </div>
        </div>
<?php  }
}
add_action( 'woocommerce_before_shop_loop_item', 'ostore_woocommerce_before_shop_loop_item', 9 );

add_action( 'woocommerce_before_single_product_summary', 'ostore_woocommerce_single_product_sale_flash', 10 );
if( !function_exists('ostore_woocommerce_single_product_sale_flash')){
    function ostore_woocommerce_single_product_sale_flash(){
        global $post, $product; if ( $product->is_on_sale() ) :
        echo (apply_filters( 'woocommerce_sale_flash', '<div class="icon-sale-label sale-left">' . __( 'Sale', 'ostore' ) . '</div>', $post, $product ));
    endif;
}
}

if (!function_exists('ostore_woocommerce_after_shop_loop_item')) {
    function ostore_woocommerce_after_shop_loop_item(){ ?>
</div>
<!-- End info wrap -->
</div>
</div>
<?php  }
}
add_action( 'woocommerce_after_shop_loop_item', 'ostore_woocommerce_after_shop_loop_item', 11 );



add_filter( 'woocommerce_show_page_title', '__return_false' );


/**
 *
**/

if( !function_exists( 'ostore_woocommerce_result_count' )){
    function ostore_woocommerce_result_count(){
        echo '<div class="toolbar">';
    }
}

add_action( 'woocommerce_before_shop_loop','ostore_woocommerce_result_count', 14 );

if( !function_exists( 'ostore_woocommerce_catalog_ordering' )){
    function ostore_woocommerce_catalog_ordering(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop','ostore_woocommerce_catalog_ordering', 36);


/**
 * WooCommerce Breadcrumbs Section
**/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
if( get_theme_mod('ostore_breadcrumb_enable',true) == true ){
    add_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 9 );
}

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'ostore_woocommerce_breadcrumbs' );
function ostore_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' &#47; ',
            'wrap_before' => '<section class="breadcrumb"><div class="container"><div class="row"><div class="col-md-12"><div class="breadcrumb_wrap"><i class="fa fa-home" aria-hidden="true"></i>',
            'wrap_after'  => '</div></div></div></div></section>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'ostore' ),
        );
}



/**
 * WooCommerce Number of row filter Function
**/

add_filter('loop_shop_columns', 'ostore_loop_columns');
if (!function_exists('ostore_loop_columns')) {
    function ostore_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'ostore_woo_body_class');
if (!function_exists('ostore_woo_body_class')) {
    function ostore_woo_body_class( $class ) {
        $class[] = 'columns-'.ostore_loop_columns();
        return $class;
    }
}

/**
 * Woo Commerce Number of Columns filter Function
**/
add_filter( 'loop_shop_per_page', 'ostore_new_loop_shop_per_page', 20 );
function ostore_new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $ostore_number_of_products_shop = get_theme_mod('ostore_number_of_products_shop',12);
    return $ostore_number_of_products_shop;
}

/**
 * Tabs Category Products Ajax Function
**/
if ( ! function_exists( 'ostore_tabs_ajax_action' ) ) {
    function ostore_tabs_ajax_action() {
        $cat_slug    = $_POST['category_slug'];
        $product_num    = $_POST['product_num'];
        ob_start();
        ?>
        <div class="tab-pane active in" id="<?php echo esc_attr( $cat_slug ); ?>">
            <div class="new-arrivals-pro">
                <div class="slider-items-products">
                    <div id="tabs-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4">
                        <?php 
                        $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'slug', 
                                'terms'     => $cat_slug                                                                 
                            )),
                        'posts_per_page' => $product_num
                    );
                        $query = new WP_Query($product_args);

                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                            
                            <?php } } wp_reset_query(); ?>
                    </div>
                    </div>
                </div>
        </div>
    </div>

<?php
$sv_html = ob_get_contents();
ob_get_clean();
echo $sv_html;
die();
}
}
add_action( 'wp_ajax_ostore_tabs_ajax_action', 'ostore_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_ostore_tabs_ajax_action', 'ostore_tabs_ajax_action' );

/*****************************************
 * WooCommerce Single Page
*******************************************/

/**
 * Product Wishlist Button Function
**/
if (defined( 'YITH_WCWL' )) { 

    function ostore_wishlist_products() {      
      global $product;
      $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
      $id =  $product->get_id();
      $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>

      <div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

            <div class="yith-wcwl-add-button show" style="display:block">  
                <a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist">
                    <i class="fa fa-heart"></i>
                </a>
            </div>

            <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> 
                <a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
            </div>

            <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                <span class="feedback"><i class="fa fa-check" aria-hidden="true"></i></span>
            </div>

            <div class="clear"></div>
            <div class="yith-wcwl-wishlistaddresponse"></div>

            </div>
    <?php
}




/**
 * Wishlist Header Count Ajax Function
**/
if ( ! function_exists( 'ostore_wishlist' ) ) {
    function ostore_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) {
            global $product;
            $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
            $id =  $product->get_id();
            $wishlist_url = YITH_WCWL()->get_wishlist_url();

            ?>
            <a href="<?php echo esc_url($wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
                <div class="count">                            
                    <i class="fa fa-heart"></i>
                    <span class="hidden-xs"><?php esc_attr_e('Wishlist', 'ostore'); ?></span>
                    <span class="badge bigcounter"><?php echo esc_html(yith_wcwl_count_products()); ?></span>
                </div>
            </a>
            <?php
        }
    }
}
add_action( 'wp_ajax__wcwl_update_single_product_list', 'ostore_wishlist' );
add_action( 'wp_ajax_nopriv__wcwl_update_single_product_list', 'ostore_wishlist' );
}

/*
*Top Header Wishlist function
*/
if(!function_exists('ostore_top_wishlist')){
    function ostore_top_wishlist() {
        if (!defined( 'YITH_WCWL' )) return;
        ?>
        <div class="wishlist-wrapper">
            <a class="quick-wishlist" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url()); ?>" title="<?php echo esc_attr("Wishlist", "ostore"); ?>">
                <i class="fa fa-heart"></i>
                <sup> <?php $wishlist_count = YITH_WCWL()->count_products();
                    echo esc_html($wishlist_count); ?>
                </sup>
            </a>
        </div>
    <?php 
    }
}

/**
 *  Add the Link to Compare Function
**/
if( defined( 'YITH_WOOCOMPARE' ) ){

    function ostore_add_compare_link2( $product_id = false, $args = array() ) {
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $product_id = ! is_null( $product ) ? yit_get_prop( $product, 'id', true ) : 0;
        }

        // return if product doesn't exist
        if ( empty( $product_id ) || apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) )
            return;
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;
        $compare = new YITH_Woocompare_Frontend();
        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', __( 'Compare', 'ostore' ) );
            do_action ( 'wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = apply_filters( 'wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text' );
        }
        printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-signal"></i></a>', esc_url( $compare->add_product_url( intval($product_id) ) ), 'compare' . ( $is_button == 'button' ? ' button' : '' ), intval($product_id), esc_html($button_text) );
        
    }
    
    function ostore_add_compare_link( $product_id = false, $args = array() ) {
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'ostore' ) );
            yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
        }
        printf( '<a title="'. esc_attr( 'Add to Compare', 'ostore' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-signal"></i></a>', '#', 'compare', intval($product_id));
    }


    remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );



}


/**
 *  Add the Link to Quick View Function
**/

if( defined( 'YITH_WCQV' ) ){
    function ostore_quickview(){
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
        echo '<a title="'. esc_attr( 'Quick View', 'ostore' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"> 
        <i class="fa fa-search"></i> 
        </a>';
    }
}

if ( ! function_exists( 'ostore_cart_link' ) ) {
    function ostore_cart_link(){ ?>
        <a class="mini-cart-link cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
            <i class="fa fa-shopping-cart"></i>
            <sup><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></sup>
        </a>
    
    <?php
    }
}

 /**
* Cart Function Area
*/
function ostore_top_cart() { ?>
<div class="top-cart-contain">
    <div class="mini-cart">
        <div data-toggle="collapse" data-hover="collapse" class="top_add_cart pull-right" data-target="#top-add-cart">

            <a class="mini-cart-link" id="AddItemCount">
                <i class="fa fa-shopping-cart"></i>
                <sup><?php echo intval(WC()->cart->get_cart_contents_count()); ?></sup>
            </a>
            
        </div>
        <div id="top-add-cart" class="collapse">
            <div class="top-cart-content">
                <div class="block-subtitle"><?php echo esc_html__('Recently added item(s)','ostore'); ?></div>
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
        </div>
    </div>
</div>
<?php 
}




function ostore_woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
        <a id="AddItemCount" class="mini-cart-link" >
            <i class="fa fa-shopping-cart"></i>
            <sup ><?php echo intval(WC()->cart->get_cart_contents_count()); ?></sup>
        </a>
    <?php
    $fragments['#AddItemCount'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'ostore_woocommerce_header_add_to_cart_fragment');


/**
 * Single Page 
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );



//Replace Ratings in popup

remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 20 );


/**
 *OStore Default loop columns on product archives.
 *
 * @return integer products per row.
 */
add_filter( 'loop_shop_columns','ostore_woocommerce_loop_columns' );
function ostore_woocommerce_loop_columns() {
    $ostore_woocommerce_loop_columns = get_theme_mod('ostore_woocommerce_loop_columns',3);
    return $ostore_woocommerce_loop_columns;
}

/**
 *Ostore Related Products Args.
*
* @param array $args related products args.
* @return array $args related products args.
*/
add_filter( 'woocommerce_output_related_products_args','ostore_woocommerce_related_products_args');
function ostore_woocommerce_related_products_args( $args ) {
    //Argument Customizer Value
    $ostore_woocommerce_related_products_posts_per_page = get_theme_mod('ostore_woocommerce_related_products_posts_per_page',3);
    $ostore_woocommerce_related_products_columns = get_theme_mod('ostore_woocommerce_related_products_columns',3);

    $defaults = array(
        'posts_per_page' => $ostore_woocommerce_related_products_posts_per_page,
        'columns'        => $ostore_woocommerce_related_products_columns,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}



/**
 * oStore Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
add_filter( 'woocommerce_product_thumbnails_columns','ostore_woocommerce_thumbnail_columns' );
function ostore_woocommerce_thumbnail_columns() {
    $ostore_woocommerce_thumbnail_columns = get_theme_mod('ostore_woocommerce_thumbnail_columns',4);
    return $ostore_woocommerce_thumbnail_columns;
}

//woocommmerce category id find
function ostore_woo_cat_id_by_slug( $slug ){
	$term = get_term_by('slug', $slug, 'product_cat', 'ARRAY_A');
	return $term['term_id'];       
}

