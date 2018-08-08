<?php
/** Woocommerce Functions & Hook **/
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
add_action('woocommerce_before_main_content','buzstores_woocommerce_wrap_start',22);

function buzstores_woocommerce_wrap_start(){
    ?>
    <div class="bs-container">
        <div class="content-wrap-main">
        	<div id="primary" class="content-area">
    		  <main id="main" class="site-main" role="main">
    <?php
}

add_action('woocommerce_after_main_content','buzstores_woocommerce_wrap_end',12);
function buzstores_woocommerce_wrap_end(){
    ?>
                </main>
            </div>
        </div>
        <?php if(!is_single()){ get_sidebar(); } ?>
    </div>
    <?php
}

add_filter( 'woocommerce_add_to_cart_fragments', 'buzstores_woocommerce_header_add_to_cart_fragment' );
function buzstores_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
    <span class="cart-count"><?php echo absint(WC()->cart->get_cart_contents_count()); ?></span> 
	<?php
	
	$fragments['span.cart-count'] = ob_get_clean();
	
	return $fragments;
}

add_action( 'woocommerce_before_shop_loop_item_title' ,'buzstores_quick_view', 11 );
function buzstores_quick_view(){
?>
    <div class="quick-view-link">
        <?php 
            $product_id = get_the_ID();
            if( function_exists( 'YITH_WCQV' ) ){
                $quick_view = YITH_WCQV_Frontend();
                remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
                $label = esc_html( get_option( 'yith-wcqv-button-label' ) );
                echo '<a href="#" class="bs-quick-view link-quickview yith-wcqv-button" data-product_id="' . intval( $product_id ) . '">' . esc_html( $label ) . '</a>';
            }
        ?>
    </div>
<?php
} 

remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
add_action('woocommerce_shop_loop_item_title','buzstores_add_link_title',11);
function buzstores_add_link_title(){
        if(get_the_title()){ ?>
            <a href="<?php the_permalink(); ?>"><h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2></a>
        <?php } 
}

add_action('woocommerce_after_shop_loop_item','buzstores_compare_button',9);
function buzstores_compare_button(){
    if( function_exists( 'YITH_WCWL' ) ){
        $product_id = get_the_ID();
            $url = add_query_arg( 'add_to_wishlist', $product_id );
            ?>
                <a class="wishlist-button" href="<?php echo esc_url($url); ?>">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </a>
            <?php
          }
}

add_action('woocommerce_after_shop_loop_item_title','buzstores_rating_price_wrap_start',4);
function buzstores_rating_price_wrap_start(){
    ?>
        <div class="price-rating">
    <?php
}

add_action('woocommerce_after_shop_loop_item_title','buzstores_rating_price_wrap_end',11);
function buzstores_rating_price_wrap_end(){
    ?>
        </div>
    <?php
}

add_action('woocommerce_before_single_product_summary','buzstores_wrap_image_saleon_wrap_start',9);
function buzstores_wrap_image_saleon_wrap_start(){
    ?>
        <div class="image-onsale">
    <?php
}
add_action('woocommerce_before_single_product_summary','buzstores_wrap_image_saleon_wrap_end',21);
function buzstores_wrap_image_saleon_wrap_end(){
    ?>
        </div>
    <?php
}


/** Category Banner **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-product-slide.php';

/** Side Banner Category Slide **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-sidebar-product-slide.php';

/** Testimonial Widget **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-category.php';

/** Tab Product Category **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-tab-category.php';

/** List Product **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-list-product.php';

/** List Product **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-multiple-product-slide.php';