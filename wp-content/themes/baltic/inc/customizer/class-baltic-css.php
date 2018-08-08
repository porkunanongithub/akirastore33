<?php
/**
 * Css selector class
 *
 * @package Baltic
 */

/**
 * Baltic CSS class.
 *
 * @since  1.0.0
 */
class Baltic_CSS {

	/**
	 * Preloader color.
	 *
	 * @return string
	 */
	public static function preloader() {

		$css = '
			.sk-rotating-plane,
			.sk-double-bounce .sk-child,
			.sk-wave .sk-rect,
			.sk-wandering-cubes .sk-cube,
			.sk-spinner-pulse,
			.sk-chasing-dots .sk-child,
			.sk-three-bounce .sk-child,
			.sk-circle .sk-child:before,
			.sk-cube-grid .sk-cube,
			.sk-fading-circle
			.sk-circle:before,
			.sk-folding-cube .sk-cube:before
		';

		return apply_filters( 'baltic_css_color_preloader', $css );

	}

	/**
	 * Text primary color css selector.
	 *
	 * @return string
	 */
	public static function text_primary() {

		$css = '
			body,
			.entry-title a,
			.page-numbers,
			.return-to-top,
			#tertiary .widget>div a
		';

		return apply_filters( 'baltic_css_color_text_primary', $css );
	}

	/**
	 * Secondary text css color selector.
	 *
	 * @return string
	 */
	public static function text_secondary() {

		$css = '
			.site-footer,
			.breadcrumb a,
			.breadcrumb .separator,
			.comment-navigation a span,
			.posts-navigation a span,
			.post-navigation a span,
			.comment-navigation a:hover span,
			.comment-navigation a:focus span,
			.posts-navigation a:hover span,
			.posts-navigation a:focus span,
			.post-navigation a:hover span,
			.post-navigation a:focus span,
			.comment-metadata a,
			.comment-body > .reply a,
			#cancel-comment-reply-link,
			#secondary a,
			.widget_tag_cloud a,
			.widget_product_tag_cloud a,
			ul.products li.product .button,
			#tertiary .widget>div,
			.woocommerce-privacy-policy-text
		';

		return apply_filters( 'baltic_css_color_text_secondary', $css );

	}

	/**
	 * Textfield css color selector.
	 *
	 * @return string
	 */
	public static function textfield() {

		$css = '
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			input[type="number"],
			input[type="tel"],
			input[type="range"],
			input[type="date"],
			input[type="month"],
			input[type="week"],
			input[type="time"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="color"],
			textarea,
			select
		';

		return apply_filters( 'baltic_css_color_textfield', $css );

	}

	/**
	 * Textfield color css selector.
	 *
	 * @return string
	 */
	public static function textfield_focus() {

		$css = '
			input[type="text"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus,
			input[type="number"]:focus,
			input[type="tel"]:focus,
			input[type="range"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="week"]:focus,
			input[type="time"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="color"]:focus,
			textarea:focus,
			select:focus
		';

		return apply_filters( 'baltic_css_color_textfield_focus', $css );

	}

	/**
	 * Button color css selector.
	 *
	 * @return string
	 */
	public static function button() {

		$css = '
			.button,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.header-search-area .search-submit:focus,
			.header-search-area .search-submit:hover,
			.return-to-top:focus,
			.return-to-top:hover,
			ul.products li.product .button:focus,
			ul.products li.product .button:hover,
			.widget_price_filter .ui-slider .ui-slider-handle,
			.widget_price_filter .ui-slider .ui-slider-range,
			.comment-form-cookies-consent input[type=checkbox]:checked~label::before,
			.comment-subscription-form input[type=checkbox]:checked~label::before
		';

		return apply_filters( 'baltic_css_color_button', $css );

	}

	/**
	 * Button hover color css selector.
	 *
	 * @return string
	 */
	public static function button_hover() {

		$css = '
			.button:hover,
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			.button:focus,
			button:focus,
			input[type="button"]:focus,
			input[type="reset"]:focus,
			input[type="submit"]:focus,
			.woocommerce-mini-cart__buttons a.button:not(.checkout):focus,
			.woocommerce-mini-cart__buttons a.button:not(.checkout):hover
		';

		return apply_filters( 'baltic_css_color_button_hover', $css );

	}

	/**
	 * Link primary color css selector.
	 *
	 * @return string
	 */
	public static function link_primary() {

		$css = '
			a,
			.page-numbers.current,
			.widget_layered_nav_filters ul li.chosen:before,
			.woocommerce-widget-layered-nav-list li.chosen:before
		';

		return apply_filters( 'baltic_css_color_link_primary', $css );

	}

	/**
	 * Link primary color css selector.
	 *
	 * @return string
	 */
	public static function link_secondary() {

		$css = '
			a:active,
			a:focus,
			a:hover,
			.breadcrumb a:hover,
			.breadcrumb a:focus,
			.entry-meta a:focus,
			.entry-meta a:hover,
			.sticky .entry-meta a:focus,
			.sticky .entry-meta a:hover,
			.entry-title a:hover,
			.entry-title a:focus,
			.sticky .entry-title a:hover,
			.sticky .entry-title a:focus,
			.entry-footer a:focus,
			.entry-footer a:hover,
			.sticky .entry-footer a:focus,
			.sticky .entry-footer a:hover,
			.site-footer a:hover,
			.site-footer a:focus,
			.comment-navigation a:hover,
			.comment-navigation a:focus,
			.posts-navigation a:hover,
			.posts-navigation a:focus,
			.post-navigation a:hover,
			.post-navigation a:focus,
			.page-numbers:focus:not(.current),
			.page-numbers:hover:not(.current),
			#secondary a:focus,
			#secondary a:hover,
			#tertiary .widget>div a:focus,
			#tertiary .widget>div a:hover
		';

		return apply_filters( 'baltic_css_color_link_secondary', $css );

	}

}
