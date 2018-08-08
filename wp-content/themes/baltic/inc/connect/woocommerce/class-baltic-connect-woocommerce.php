<?php
/**
 * WooCommerce connector.
 *
 * @package Baltic
 */

/**
 * Baltic_Connect_WooCommerce class.
 *
 * @since  1.0.0
 */
class Baltic_Connect_WooCommerce {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Connect_WooCommerce
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Connect_WooCommerce An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function __construct() {

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		add_action( 'after_setup_theme', 	array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', 	array( $this, 'scripts' ) );

		add_filter( 'body_class', 			array( $this, 'body_classes' ) );
		add_filter( 'post_class', 			array( $this, 'post_classes' ) );

		add_action( 'baltic_meta', array( $this, 'force_layout' ) );

		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		add_filter( 'loop_shop_per_page', 	array( $this, 'products_per_page' ) );
		add_filter( 'loop_shop_columns', 	array( $this, 'loop_columns' ) );
		add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
		add_filter( 'woocommerce_upsell_display_args', array( $this, 'related_products_args' ) );

		add_filter( 'baltic_archive_crumb', array( $this, 'breadcrumb_args' ), 10, 2 );
		add_filter( 'baltic_single_crumb', array( $this, 'breadcrumb_args' ), 10, 2 );

		Baltic_WooCommerce_Template::instance();
		Baltic_WooCommerce_Thumbnail::instance();

	}

	/**
	 * Theme support.
	 *
	 * @return void
	 */
	public function setup() {

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
	public function scripts() {

		$suffix = Baltic_Utility::get_min_suffix();

		wp_enqueue_style( 'baltic-woocommerce-style',
			BALTIC_URI . "/assets/css/woocommerce$suffix.css"
		);
		wp_style_add_data( 'baltic-woocommerce-style', 'rtl', 'replace' );

		$font_path   	= WC()->plugin_url() . '/assets/fonts/';
		$images_path 	= WC()->plugin_url() . '/assets/images/';
		$inline_style 	= '
			@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}
			a.wcppec-cart-widget-button,
			a.wcppec-checkout-buttons__button {
				background-image: url("'. $images_path . 'paypal.png");
			}
		';

		$inline_style = str_replace( array( "\n", "\t", "\r" ), '', $inline_style );

		wp_add_inline_style( 'baltic-woocommerce-style', $inline_style );

	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {

		$classes[]	= esc_attr( Baltic_Layout::get_shop_layout() );

		return $classes;

	}

	/**
	 * Post classes for WooCommerce page.
	 *
	 * @param array $classes Classes for the post element.
	 * @return array
	 */
	public function post_classes( $classes ) {

		return $classes;

	}

	/**
	 * Force layout on certain WooCommerce page.
	 *
	 * @return void
	 */
	public function force_layout() {

		if ( is_page( wc_get_page_id( 'checkout' ) ) || is_page( wc_get_page_id( 'cart' ) ) ) {
			add_filter( 'baltic_site_layout', array( 'Baltic_Layout', 'get_full_width' ) );
		}

		if ( get_option( 'yith-wcwl-page-id' ) != '' ) {
			if ( is_page( get_option( 'yith-wcwl-page-id' ) ) ) {
				add_filter( 'baltic_site_layout', array( 'Baltic_Layout', 'get_full_width' ) );
			}
		}

	}

	/**
	 * Products per page.
	 *
	 * @return integer number of products.
	 */
	public function products_per_page() {
		return absint( Baltic_Options::get_option( 'products_per_page' ) );
	}

	/**
	 * Default loop columns on product archives.
	 *
	 * @return integer products per row.
	 */
	public function loop_columns() {
		return absint( Baltic_Options::get_option( 'products_columns' ) );
	}

	/**
	 * Product gallery thumnbail columns.
	 *
	 * @return integer number of columns.
	 */
	public function thumbnail_columns() {
		return 4;
	}

	/**
	 * Related Products Args.
	 *
	 * @param array $args related products args.
	 * @return array $args related products args.
	 */
	public function related_products_args( $args ) {

		$count = ( Baltic_Layout::get_shop_layout() === 'full-width' ) ? 4 : 3;

		$defaults = array(
			'posts_per_page' => $count,
			'columns'        => $count,
		);

		$args = wp_parse_args( $defaults, $args );

		return $args;
	}

	/**
	 * Breadcrumb args for shop.
	 *
	 * @uses Baltic_Utility::get_breadcrumb_link()
	 * @param array $args related products args.
	 * @return array $args related products args.
	 */
	public function breadcrumb_args( $crumb, $args ) {

		$shop_id 	= wc_get_page_id( 'shop' );
		$shop_title = get_the_title( $shop_id );
		$shop_url 	= get_permalink( $shop_id );

		/** Are we on the product archive page? */
		if ( is_post_type_archive( 'product') && get_option( 'page_on_front' ) !== wc_get_page_id( 'shop' ) ) {

			$shop_id = wc_get_page_id( 'shop' );

			$shop_name = $shop_id ? get_the_title( $shop_id ) : ucwords( get_option( 'woocommerce_shop_slug' ) );

			if ( is_search() ) :

				$crumb = Baltic_Utility::get_breadcrumb_link( get_post_type_archive_link( 'product' ), $shop_name, $shop_name, $args['sep'] . __( 'Search results for &ldquo;', 'baltic' ) . get_search_query() . '&rdquo;' );

			else :

				$crumb = $shop_name;

			endif;

		}

		/** Are we on a shop taxonomy archive page? */
		if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {

			$crumb = '';

			$prepend = '';

			if ( $shop_url && $shop_id && get_option( 'page_on_front' ) !== $shop_id )
				$prepend = Baltic_Utility::get_breadcrumb_link( get_permalink( $shop_id ), $shop_title, $shop_title, $args['sep'] );

		}

		if ( is_tax( 'product_cat' ) ) {

			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

			$parents = array();
			$parent = $term->parent;
			while ( $parent ):
				$parents[] = $parent;
				$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
				$parent = $new_parent->parent;
			endwhile;

			$crumb .= $prepend;

			if ( ! empty( $parents ) ) :
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ) :
					$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
					$crumb .= Baltic_Utility::get_breadcrumb_link( get_term_link( $item->slug, 'product_cat' ), $item->name, $item->name, $args['sep'] );
				endforeach;
			endif;

			$crumb .= single_term_title( '', false );

			return $crumb;
		}

		if ( is_tax( 'product_tag' ) ) {

			$crumb .= $prepend . __( 'Products tagged &ldquo;', 'baltic' ) . single_term_title( '', false ) . _x( '&rdquo;', 'endquote', 'baltic' );

			return $crumb;
		}

		/** Are we on a single product page? */
		if ( is_singular( 'product' ) ) {

			global $post;

			$crumb = '';
			$prepend = '';

			if ( $shop_url && $shop_id && get_option( 'page_on_front' ) !== $shop_id )
				$prepend = Baltic_Utility::get_breadcrumb_link( get_permalink( $shop_id ), $shop_title, $shop_title, $args['sep'] );

			$crumb .= $prepend;

			if ( $terms = wp_get_object_terms( $post->ID, 'product_cat' ) ) :
				$term = current( $terms );
				$parents = array();
				$parent = $term->parent;
				while ( $parent ):
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, 'product_cat' );
					$parent = $new_parent->parent;
				endwhile;

				if( ! empty( $parents ) ):
					$parents = array_reverse( $parents );
					foreach ( $parents as $parent ) :
						$item = get_term_by( 'id', $parent, 'product_cat' );
						$crumb .= Baltic_Utility::get_breadcrumb_link( get_term_link( $item->slug, 'product_cat' ), $item->name, $item->name, $args['sep'] );
					endforeach;
				endif;
				$crumb .= Baltic_Utility::get_breadcrumb_link( get_term_link( $term->slug, 'product_cat' ), $term->name, $term->name, $args['sep'] );
			endif;

			$crumb .= '<span>'. get_the_title() .'</span>';

		}

		return $crumb;

	}

}
