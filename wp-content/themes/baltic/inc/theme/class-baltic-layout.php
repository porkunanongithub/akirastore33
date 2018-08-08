<?php
/**
 * Baltic Layout
 *
 * @package  Baltic
 */

/**
 * Baltic Layout class.
 *
 * @since  1.0.0
 */
class Baltic_Layout {

	/**
	 * [get_layout description]
	 *
	 * @return [type] [description]
	 */
	public static function get_layout() {

		$layout = '';

		if ( Baltic_Utility::is_blog() ) {
			$layout = Baltic_Options::get_option( 'layout_archive' );
		} elseif ( is_singular( 'post' ) ) {
			$layout = Baltic_Options::get_option( 'layout_post' );
		} elseif( is_singular( 'page' ) ) {
			$layout = Baltic_Options::get_option( 'layout_page' );
		}

		return apply_filters( 'baltic_site_layout', $layout );

	}

	/**
	 * [get_shop_layout description]
	 *
	 * @return [type] [description]
	 */
	public static function get_shop_layout() {

		$layout = '';

		if ( is_post_type_archive( 'product' ) && is_search() ) {
			$layout = esc_attr( Baltic_Options::get_option( 'layout_products' ) );
		} elseif ( is_shop() || is_product_category() || is_product_tag() ) {
			$layout = esc_attr( Baltic_Options::get_option( 'layout_products' ) );
		} elseif ( is_product() ) {
			$layout = esc_attr( Baltic_Options::get_option( 'layout_product' ) );
		}

		return apply_filters( 'baltic_products_layout', $layout );

	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return [type] [description]
	 */
	public static function get_content_sidebar() {
		return 'content-sidebar';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return [type] [description]
	 */
	public static function get_sidebar_content() {
		return 'sidebar-content';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return [type] [description]
	 */
	public static function get_narrow() {
		return 'narrow';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return [type] [description]
	 */
	public static function get_full_width() {
		return 'full-width';
	}

}
