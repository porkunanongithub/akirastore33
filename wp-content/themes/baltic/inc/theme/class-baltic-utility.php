<?php
/**
 * Baltic Utility class.
 *
 * @package Baltic
 */

/**
 * Main Baltic Utility class.
 *
 * @since  1.0.0
 */
class Baltic_Utility {

	/**
	 * [get_min_suffix description]
	 *
	 * @return [type] [description]
	 */
	public static function get_min_suffix() {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}

	/**
	 * [is_sticky description]
	 *
	 * @return boolean [description]
	 */
	public static function is_sticky() {
		return (bool) is_sticky() && ! is_paged() && ! is_singular() && ! is_archive();
	}

	/**
	 * [is_blog description]
	 *
	 * @return boolean [description]
	 */
	public static function is_blog() {
		return (bool) is_home() || is_category() || is_tag() || is_author() || is_date() || is_search();
	}

	/**
	 * [is_woocommerce description]
	 *
	 * @return boolean [description]
	 */
	public static function is_woocommerce() {
		if ( function_exists( 'is_woocommerce' ) ) {
			return (bool) is_woocommerce();
		}
	}

	/**
	 * [is_homepage_template description]
	 *
	 * @return boolean [description]
	 */
	public static function is_homepage_template() {
		return (bool) is_page_template( 'baltic-homepage.php' );
	}

	/**
	 * [is_homepage_woocommerce description]
	 *
	 * @return boolean [description]
	 */
	public static function is_homepage_woocommerce() {

		if ( ! class_exists( 'WooCommerce' ) ) {

			if ( is_customize_preview() ) {
				echo '<div class="baltic-require-plugin">';
				echo esc_html__( 'This homepage block require WooCommerce plugin', 'baltic' );
				echo '</div>';
			}

			return true;
		}

	}

	/**
	 * [is_homepage_twitter description]
	 *
	 * @return boolean [description]
	 */
	public static function is_homepage_twitter() {

		if ( ! defined( 'CAMPAIGNKIT_TWITTER_NAME' ) ) {

			if ( is_customize_preview() ) {
				echo '<div class="baltic-require-plugin">';
				echo esc_html__( 'This homepage block require Campaignkit Twitter plugin', 'baltic' );
				echo '</div>';
			}

			return true;
		}

	}

	/**
	 * Helper function for the Baltic Breadcrumb Class.
	 *
	 * @return string HTML markup for anchor link and optional separator.
	 */
	public static function get_breadcrumb_link( $url, $title, $content, $sep = '' ) {

		$link = sprintf( '<a href="%s" title="%s">%s</a>',
			esc_attr( $url ),
			esc_attr( $title ),
			esc_html( $content )
		);

		if ( $sep ){
			$link .= $sep;
		}

		return $link;

	}

	/**
	 * Baltic Main layout selector
	 *
	 * @return array available layout
	 */
	public static function get_main_layout() {

		$layout = array(
			'content-sidebar'  	=> esc_attr__( 'Content Sidebar', 'baltic' ),
			'sidebar-content' 	=> esc_attr__( 'Sidebar Content', 'baltic' ),
			'full-width' 		=> esc_attr__( 'Full Width', 'baltic' ),
			'narrow'	 		=> esc_attr__( 'Narrow', 'baltic' ),
		);

		return apply_filters( 'baltic_main_layout', $layout );

	}

	/**
	 * Baltic Main layout selector
	 *
	 * @return array available layout
	 */
	public static function get_posts_layout() {

		$layout = array(
			'default'  	=> esc_attr__( 'Default', 'baltic' ),
			'grid' 		=> esc_attr__( 'Grid', 'baltic' ),
			'zig-zag' 	=> esc_attr__( 'Zig Zag', 'baltic' ),
		);

		return apply_filters( 'baltic_main_layout', $layout );

	}

	/**
	 * Button style.
	 *
	 * @return array
	 */
	public static function get_button_style() {

		$button = array(
			'primary'   		=> esc_attr__( 'Primary', 'baltic' ),
			'secondary' 		=> esc_attr__( 'Secondary', 'baltic' ),
			'success' 			=> esc_attr__( 'Success', 'baltic' ),
			'danger'  			=> esc_attr__( 'Danger', 'baltic' ),
			'warning'  			=> esc_attr__( 'Warning', 'baltic' ),
			'info'  			=> esc_attr__( 'Info', 'baltic' ),
			'white'  			=> esc_attr__( 'White', 'baltic' ),
			'outline-primary'   => esc_attr__( 'Primary Outline', 'baltic' ),
			'outline-secondary' => esc_attr__( 'Secondary Outline', 'baltic' ),
			'outline-success'  	=> esc_attr__( 'Success Outline', 'baltic' ),
			'outline-danger'  	=> esc_attr__( 'Danger Outline', 'baltic' ),
			'outline-warning'  	=> esc_attr__( 'Warning Outline', 'baltic' ),
			'outline-info'  	=> esc_attr__( 'Info Outline', 'baltic' ),
			'outline-white'  	=> esc_attr__( 'White Outline', 'baltic' ),
		);

		return apply_filters( 'baltic_button_style', $button );

	}

	/**
	 * Payment icons.
	 *
	 * @return array
	 */
	public static function get_payment_icons() {

		$icons = array(
			'alipay'		=> esc_html__( 'Alipay', 'baltic' ),
			'amex'			=> esc_html__( 'Amex', 'baltic' ),
			'diners'		=> esc_html__( 'Diners', 'baltic' ),
			'discover'		=> esc_html__( 'Discover', 'baltic' ),
			'elo'			=> esc_html__( 'Elo', 'baltic' ),
			'hipercard'		=> esc_html__( 'Hipercard', 'baltic' ),
			'jcb'			=> esc_html__( 'JCB', 'baltic' ),
			'maestro'		=> esc_html__( 'Maestro', 'baltic' ),
			'mastercard'	=> esc_html__( 'Mastercard', 'baltic' ),
			'paypal'		=> esc_html__( 'Paypal', 'baltic' ),
			'unionpay'		=> esc_html__( 'Unionpay', 'baltic' ),
			'verve'			=> esc_html__( 'Verve', 'baltic' ),
			'visa'			=> esc_html__( 'Visa', 'baltic' ),
		);

		return apply_filters( 'baltic_payment_icons', $icons );

	}

	/**
	 * Get an array of terms from a taxonomy.
	 *
	 * @param string|array $taxonomies See https://developer.wordpress.org/reference/functions/get_terms/ for details.
	 * @return array
	 */
	public static function get_terms( $taxonomies ) {

		$items = array();

		// Get the post types.
		$terms = get_terms( array(
	    	'taxonomy' 		=> $taxonomies
		) );

		// Build the array.
		foreach ( $terms as $term ) {
			$items[ $term->term_id ] = $term->name;
		}

		return $items;

	}

	/**
	 * Get an array of terms from a taxonomy.
	 *
	 * @param string|array $taxonomies See https://developer.wordpress.org/reference/functions/get_terms/ for details.
	 * @return array
	 */
	public static function get_terms_slug( $taxonomies ) {

		$items = array();

		// Get the post types.
		$terms = get_terms( array(
	    	'taxonomy' 		=> $taxonomies
		) );

		// Build the array.
		foreach ( $terms as $term ) {
			$items[ $term->slug ] = $term->name;
		}

		return $items;

	}

	/**
	 * Add notification for plugin requirement.
	 *
	 * @param  string  $support name of the required plugin
	 * @return boolean
	 */
	public static function unsupported_blocks( $support ) {

		if ( $support == 'woocommerce' ) {

			if ( ! class_exists( 'WooCommerce' ) ) {

				if ( is_customize_preview() ) {
					echo '<div class="baltic-require-plugin">';
					// Translators: %s is a plugin name
					echo sprintf( esc_html__( 'This homepage block require %s plugin.', 'baltic' ),
						esc_attr( 'WooCommerce' )
					);
					echo '</div>';
				}

				return true;
			}

		} elseif( $support == 'twitter' ) {

			if ( ! defined( 'CAMPAIGNKIT_TWITTER_NAME' ) ) {

				if ( is_customize_preview() ) {
					echo '<div class="baltic-require-plugin">';
					// Translators: %s is a plugin name
					echo sprintf( esc_html__( 'This homepage block require %s plugin.', 'baltic' ),
						esc_attr( 'Campaign Kit Twitter Widget' )
					);
					echo '</div>';
				}

				return true;
			}

		}

	}

}
