<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Ganess_Store
 */

class Ganess_Store_Wocommerce{

	function __construct(){

		remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );

		add_filter( 'body_class', array( $this,'ganess_store_woocommerce_active_body_class' ) );
		add_filter( 'loop_shop_per_page',array( $this,'ganess_store_woocommerce_products_per_page' ) );
		add_filter( 'woocommerce_product_thumbnails_columns',array( $this,'ganess_store_woocommerce_thumbnail_columns' ));
		add_filter( 'woocommerce_output_related_products_args',array( $this,'ganess_store_woocommerce_related_products_args' ));

		add_filter('woocommerce_add_to_cart_fragments',array( $this,'ganess_store_woocommerce_header_add_to_cart_fragment' ));

		add_filter('loop_shop_columns',array( $this,'ganess_store_woocommerce_thumbnail_columns' ));
	
		add_action( 'after_setup_theme',array( $this,'ganess_store_woocommerce_setup') );
		add_action( 'wp_enqueue_scripts',array($this,'ganess_store_woocommerce_scripts') );
	}

	/**
	 * WooCommerce setup function.
	 *
	 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
	 *
	 * @return void
	 */
	function ganess_store_woocommerce_setup() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @return void
	 */
	function ganess_store_woocommerce_scripts() {
		wp_enqueue_style( 'ganess-store-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' );

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

		wp_add_inline_style( 'ganess-store-woocommerce-style', $inline_font );
	}


	/**
	 *  Add the Link to Quick View Function
	**/
	public function ganess_store_quickview(){
		if ( !defined( 'YITH_WCQV' )) return;

        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
        echo '<a title="'. esc_html( 'Quick View', 'ganess-store' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"> 
        <i class="fa fa-search"></i> 
        </a>';

	}
	
	/** Add Compare Links */
	public function add_compare_link( $product_id = false, $args = array() ) {
    	if( !defined( 'YITH_WOOCOMPARE' ) ) return;
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        if ( ! isset( $button_text ) || $button_text == 'default' and function_exists( 'yit_wpml_register_string') ) {
            $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'ganess-store' ) );
            yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
        }
        printf( '<a title="'. esc_attr__( 'Add to Compare', 'ganess-store' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="sprite compare"></i></a>', '#', 'compare', intval($product_id));
    }

    /**
	 * Add 'woocommerce-active' class to the body tag.
	 *
	 * @param  array $classes CSS classes applied to the body tag.
	 * @return array $classes modified to include 'woocommerce-active' class.
	 */
	public function ganess_store_woocommerce_active_body_class( $classes ) {
		$classes[] = 'woocommerce-active';

		return $classes;
	}


	/**
	 * Products per page.
	 *
	 * @return integer number of products.
	 */
	public function ganess_store_woocommerce_products_per_page() {
		$ganess_store_woocommerce_products_per_page = get_theme_mod('ganess_store_woocommerce_products_per_page',12);
		return $ganess_store_woocommerce_products_per_page;
	}


	/**
	 * Product gallery thumnbail columns.
	 *
	 * @return integer number of columns.
	 */
	public function ganess_store_woocommerce_thumbnail_columns() {
		$ganess_store_woocommerce_thumbnail_columns = get_theme_mod( 'ganess_store_woocommerce_thumbnail_columns',3 );
		return $ganess_store_woocommerce_thumbnail_columns;
	}


	/**
	 * Related Products Args.
	 *
	 * @param array $args related products args.
	 * @return array $args related products args.
	 */
	public function ganess_store_woocommerce_related_products_args( $args ) {
		//Related Products Settings
		$ganess_store_woocommerce_related_products_posts_per_page = get_theme_mod( 'ganess_store_woocommerce_related_products_posts_per_page',2 );
		$ganess_store_woocommerce_related_products_columns = get_theme_mod( 'ganess_store_woocommerce_related_products_columns',2 );
		
		$defaults = array(
			'posts_per_page' => $ganess_store_woocommerce_related_products_posts_per_page,
			'columns'        => $ganess_store_woocommerce_related_products_columns,
		);
		$args = wp_parse_args( $defaults, $args );

		return $args;
	}


	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	public function ganess_store_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		global $woocommerce; 

		
		?>
		<div class="top-cart-contain cell large-auto grid-x large-3 medium-12 align-middle align-right medium-order-2 large-order-3 small-order-4 small-6" id="cart">
			<?php do_action('ganess_store_header_account'); ?>
			<div class="mini-cart">
		        <div data-toggle="collapse" data-hover="collapse" class="top_add_cart " data-target="#top-add-cart">

		        	<div id="cart_new" class="">
						<i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp;
					    <strong class="hide-for-small-only" id="miniCartItemCount" ><a href="#"><?php echo intval(WC()->cart->get_cart_contents_count()); ?></a></strong>
					    <span class="hide-for-small-only"><?php echo esc_html__('Items','ganess-store'); ?></span> &nbsp;
					    <strong><a href="#"><?php $woocommerce->cart->get_cart_total(); ?></a></strong>
					</div>
		            
		        </div>
		        <div id="top-add-cart" class="collapse">
		            <div class="top-cart-content">
		                <div class="block-subtitle"><?php echo esc_html__('Recently added item(s)','ganess-store'); ?></div>
		                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		            </div>
		        </div>
		    </div>
		</div>
		<?php
	}


	public function ganess_store_woocommerce_header_add_to_cart_fragment($fragments) {
	    ob_start();
	    global $woocommerce;
	    ?>
		<div id="cart_new" class="">
			<i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp;
			<strong class="hide-for-small-only" id="miniCartItemCount" ><a href="#"><?php echo intval(WC()->cart->get_cart_contents_count()); ?></a></strong>
			<span class="hide-for-small-only"><?php echo esc_html__('Items','ganess-store'); ?></span> &nbsp;
			<strong><a href="#"><?php $woocommerce->cart->get_cart_total(); ?></a></strong>
		</div>
	    <?php
	    $fragments['#cart_new'] = ob_get_clean();
	    return $fragments;
	}


	/*woocommerce Product Rating Star */
	public function ganess_store_get_star_rating()
		{
	    global $woocommerce, $product;
	    $average = $product->get_average_rating();
		
		for( $i = 1; $i<=5; $i++ ) {
			if ($i<=$average){
				echo '<i class="fa fa-star gold" aria-hidden="true"></i>';
			}
			else{ 
				echo '<i class="fa fa-star blank" aria-hidden="true"></i>';
			} 
		} 
	}

    /**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	 public function ganess_store_woocommerce_cart_link() {
		?>
			<a class="grid-x align-middle align-justify button hollow purple" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ganess-store' ); ?>">
				<i class="cell sprite addcart"></i>
				<span class="cell"><?php  echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
				<span class="cell"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'ganess-store' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>

		<?php
	}

}
global $Ganess_Store_Woocommerce;
$Ganess_Store_Woocommerce = new Ganess_Store_Wocommerce();


/**
 * Woo Commerce Add Content Primary Div Function
**/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('ganess_store_woocommerce_output_content_wrapper')) {
    function ganess_store_woocommerce_output_content_wrapper(){ ?>
    <section id="product">
      <div class="grid-container margin-con">
          <div class="grid-x  grid-margin-x grid-margin-y">
            <div class="large-8 medium-8 small-12 cell mobile-ctrl">
            <?php   }
        }
        add_action( 'woocommerce_before_main_content', 'ganess_store_woocommerce_output_content_wrapper', 10 );

        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        if (!function_exists('ganess_store_woocommerce_output_content_wrapper_end')) {
            function ganess_store_woocommerce_output_content_wrapper_end(){ ?>
        </div>
        <?php get_sidebar('woocommerce'); ?>
    </div><!-- row -->
</div><!-- container -->
</section><!-- main-container -->
<?php   }
}
add_action( 'woocommerce_after_main_content', 'ganess_store_woocommerce_output_content_wrapper_end', 10 );


if ( ! function_exists( 'ganess_store_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function ganess_store_woocommerce_product_columns_wrapper() {
		
		?>
			<div class="tabs-panel is-active" id="panel1">
                  <div id="horizontal-grid">
                    <div class="tabs-content" data-active-collapse="true" data-tabs-content="product-tabs">
                      <div class="tabs-panel is-active" id="top-seller">
                        <div class="container-grid align-center">

			
        <?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'ganess_store_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'ganess_store_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function ganess_store_woocommerce_product_columns_wrapper_close() {
		?>				</div>
					</div>
				</div>	
			</div>
		</div>

		<?php 
	}
}
add_action( 'woocommerce_after_shop_loop', 'ganess_store_woocommerce_product_columns_wrapper_close', 40 );


/**
 * Product Cateogry page
 * WooCommerce Manage Product Div Structure
*/
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );


if (!function_exists('ganess_store_woocommerce_before_shop_loop_item')) {
    function ganess_store_woocommerce_before_shop_loop_item(){ ?>
    <div class="item cell large-3 medium-4 small-6">
        <span class="hover">
        	<span class="button-container align-middle align-justify align-center-middle grid-x grid-container text-center">
				<?php 
					global $Ganess_Store_Woocommerce;
					$Ganess_Store_Woocommerce->add_compare_link();
					$Ganess_Store_Woocommerce->ganess_store_quickview(); 
					ganess_store_wishlist_products();
				?>
        	</span>
			<span class="text-container">
					<button type="button" class="detail-buttom"> <a href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i><span><?php echo esc_html__('Details','ganess-store'); ?></span> </a></button>
					<button type="button" class="add-to-cart-mt"> <span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </button>
			</span>
        </span>
        <span class="image-container">
        	<?php global $post, $product; if ( $product->is_on_sale() ) : 
                echo apply_filters( 'woocommerce_sale_flash', '<span class="sale">' . esc_html__( 'SALE', 'ganess-store' ) . '</span>', $post, $product ); ?>
            <?php endif; ?>
        	<?php the_post_thumbnail( 'woocommerce_thumbnail' );  ?>
        </span>
        <span class="text-container">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<span class="rating"><?php $Ganess_Store_Woocommerce->ganess_store_get_star_rating(); ?></span>
			<span class="price"><?php woocommerce_template_loop_price(); ?></span>
        </span>
    </div>
                    
    <?php  }
}
add_action( 'woocommerce_before_shop_loop_item', 'ganess_store_woocommerce_before_shop_loop_item', 9 );


if (!function_exists('ganess_store_woocommerce_after_shop_loop_item')) {
    function ganess_store_woocommerce_after_shop_loop_item(){ ?>
    				<!-- </div> -->
        		<!-- /div>
            </div> -->
    <?php  }
}
add_action( 'woocommerce_after_shop_loop_item', 'ganess_store_woocommerce_after_shop_loop_item', 11 );


	/***************************************
	Ganess Store Wrapper Class
	**************************************/
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function ganess_store_woocommerce_wrapper_before() {
		
			?>
			<section id="product">
		        <div class="grid-container margin-con">
					<div class="grid-x grid-margin-x grid-margin-y">
						
		<?php
	}

	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	 function ganess_store_woocommerce_wrapper_after() {
		?>		
				</div>
			</div>
		</section>
		<?php
	}

/***
*Single Page Recen post
*/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	
	add_action( 'woocommerce_after_single_product_summary', 'ganess_store_woocommerce_output_upsells', 15 );
	if ( ! function_exists( 'ganess_store_woocommerce_output_upsells' ) ) {
		function ganess_store_woocommerce_output_upsells() {
			?>
			<div class="tabs-panel is-active" id="panel1">
					<div id="horizontal-grid">
						<div class="tabs-content" data-active-collapse="true" data-tabs-content="product-tabs">
							<div class="tabs-panel is-active" id="top-seller">
								<div class="upsell-list">
									<?php	woocommerce_upsell_display( 2,1 ); ?>
<?php
		}
	}

	remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
	add_action( 'woocommerce_after_single_product', 'ganess_store_woocommerce_output_upsells_wrapper', 10 );

	if ( ! function_exists( 'ganess_store_woocommerce_output_upsells_wrapper' ) ) {
		function ganess_store_woocommerce_output_upsells_wrapper() {
			?>
			
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		}
	}

/**********************************************************
 * 				How to Filter The Breadcrumb 
 * *******************************************************/ 
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

//Add The New Breadcrumb in Ganess Theme
if( !function_exists( 'ganess_store_woocommerce_breadcrumb' )){
    function ganess_store_woocommerce_breadcrumb(){
		ganess_store_breadcrumb_woocommerce();
	}
}
//Woocommerce Breadcumb Section
if( get_theme_mod('ganess_store_woocommerce_breadcrumb_menu_enable',true) == true ){
	add_action( 'woocommerce_before_main_content','ganess_store_woocommerce_breadcrumb', 9 );
}


//Wishlist Product add
if ( !function_exists ('ganess_store_wishlist_products') ) {
	function ganess_store_wishlist_products() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

				<div class="yith-wcwl-add-button show" >  
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistaddedbrowse hide" > 
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistexistsbrowse hide" >
					<i class="fa fa-check" aria-hidden="true"></i>
				</div>

				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>

			</div>
			<?php
		}
	}
}

/**
 * Single Page 
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );



//Replace Ratings in popup

remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 20 );

//woocommmerce category id find
function ganess_store_woo_cat_id_by_slug( $slug ){
	$term = get_term_by('slug', $slug, 'product_cat', 'ARRAY_A');
	return $term['term_id'];       
}