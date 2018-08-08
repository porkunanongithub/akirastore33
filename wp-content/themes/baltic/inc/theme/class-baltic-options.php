<?php
/**
 * Class Baltic Options.
 *
 * @package Baltic
 */

/**
 * Main Baltic Options class.
 *
 * @since  1.0.0
 */
class Baltic_Options {

	/**
	 * Get theme option.
	 *
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public static function get_option( $name ) {

		$default = self::defaults();

		if ( array_key_exists( $name, $default ) ) {
			return get_theme_mod( esc_attr( $name ), $default[$name] );
		} else {
			return get_theme_mod( esc_attr( $name ) );
		}

	}

	/**
	 * Return custom field post meta data.
	 *
	 * @return string|boolean Return value or empty string on failure.
	 */
	public static function get_custom_field( $field, $post_id = null ) {

		// Use get_the_ID() if no $post_id is specified
		$post_id = empty( $post_id ) ? get_the_ID() : $post_id;

		if ( ! $post_id ) {
			return '';
		}

		$custom_field = get_post_meta( $post_id, $field, true );

		if ( ! $custom_field ) {
			return '';
		}

		// Return custom field, slashes stripped, sanitized if string
		return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

	}

	/**
	 * Default settings.
	 *
	 * @return array default settings value
	 */
	public static function defaults() {

		$defaults = array(
			// Preloader
			'preloader'					=> true,
			'preloader_type'			=> 'pulse',
			'preloader_color'			=> '#ff5722',
			'preloader_bg_color'		=> '#ffffff',

			// Text colors
			'color_bg_highlight'		=> '#ff5722',
			'color_text_highlight'		=> '#ffffff',
			'color_text_primary'		=> '#505050',
			'color_text_secondary'		=> '#909090',
			'color_text_field'			=> '#909090',
			'color_text_field_focus'	=> '#505050',
			'color_link_primary'		=> '#ff5722',
			'color_link_secondary'		=> '#ff8a65',
			'color_text_button'			=> '#ffffff',
			'color_button'				=> '#ff5722',
			'color_button_hover'		=> '#ff8a65',
			'color_border'				=> 'rgba(0,0,0,0.1)',

			// Header color
			'color_bg_header'			=> '#ffffff',
			'color_text_header'			=> '#505050',
			'color_header_input'		=> 'rgba(255,255,255,0.5)',
			'color_header_input_focus'	=> 'rgba(255,255,255,1)',
			'color_header_input_border'	=> 'rgba(0,0,0,0.1)',
			'color_header_input_border_focus'	=> 'rgba(0,0,0,0.1)',
			'color_header_textfield'	=> '#909090',
			'color_header_textfield_focus'	=> '#505050',
			'color_header_btn'			=> 'rgba(255,255,255,0.5)',
			'color_header_btn_hover'	=> '#ff5722',
			'color_header_btn_icon'		=> '#505050',
			'color_header_btn_icon_hover'	=> '#ffffff',

			// Layout
			'layout_archive'			=> 'content-sidebar',
			'layout_post'				=> 'content-sidebar',
			'layout_page'				=> 'content-sidebar',

			// Blog post
			'thumb_placeholder'			=> '',
			'meta_date'					=> true,
			'meta_author'				=> true,
			'meta_comment'				=> true,
			'meta_categories'			=> true,
			'meta_tags'					=> true,
			'author_profile'			=> true,
			'excerpt_length'			=> 30,
			'more_link_text'			=> esc_html__( 'Continue reading', 'baltic' ),
			'nav_posts'					=> 'posts_pagination',
			'nav_posts_prev'			=> esc_html( '&larr; Older posts', 'baltic' ),
			'nav_posts_next'			=> esc_html( 'Newer posts &rarr;', 'baltic' ),

			// Footer
			'footer_widgets_col'		=> 4,
			'footer_text'				=> esc_html__( 'Copyright &copy; 2017-{{YEAR}} {{SITE}}. Proudly powered by {{WP}}.', 'baltic' ),
			'footer_credits'			=> true,
			'return_top'				=> true,
			'payment_icons'				=> '',

			// WooCommerce
			'color_price'				=> '#77a464',
			'color_sale_text'			=> '#ffffff',
			'color_sale'				=> '#f44336',
			'color_stars'				=> '#ffc107',
			'layout_products'			=> 'full-width',
			'layout_product'			=> 'content-sidebar',
			'products_per_page'			=> 12,
			'products_columns'			=> 4,
			'product_quick_view'		=> true,
			'products_nav'				=> 'products_pagination',
			'products_nav_prev'			=> esc_html( '&larr; Older product', 'baltic' ),
			'products_nav_next'			=> esc_html( 'Newer product &rarr;', 'baltic' ),

		);

		return apply_filters( 'baltic_setting_defaults', $defaults );

	}

}
