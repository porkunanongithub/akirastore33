<?php
/**
 * Baltic header structure
 *
 * @package Baltic
 */

/**
 * Baltic Structure Header.
 *
 * @since  1.0.0
 */
class Baltic_Header {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Header
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Header An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function __construct() {

		// Before header
		add_action( 'baltic_before', array( __class__, 'do_preloader' ), 10 );
		add_action( 'baltic_before', array( __class__, 'do_skip_links' ), 20 );

		// Header
		add_action( 'baltic_header', array( __class__, 'wrap_open' ), 10 );
		add_action( 'baltic_header', array( __class__, 'do_header_toggle' ), 10 );
		add_action( 'baltic_header', array( __class__, 'do_site_branding' ), 20 );
		add_action( 'baltic_header', array( __class__, 'do_header_search' ), 30 );
		add_action( 'baltic_header', array( __class__, 'wrap_close' ), 40 );
		add_action( 'baltic_header', array( __class__, 'do_header_navigation' ), 40 );

	}

	/**
	 * Preloader.
	 *
	 * @return string html
	 */
	public static function do_preloader() {

		if ( Baltic_Options::get_option( 'preloader' ) === true ) {
			echo '<div class="site-preloader">';
			Baltic_Components::preloader();
			echo '</div>';
		}

	}

	public static function wrap_open() {
		echo '<div class="wrap">';
	}

	public static function wrap_close() {
		echo '</div>';
	}

	/**
	 * Skip links.
	 *
	 * @return string html
	 */
	public static function do_skip_links() {
		get_template_part( 'components/header/skip', 'links' );
	}

	/**
	 * Header toggle.
	 *
	 * @return string html
	 */
	public static function do_header_toggle() {
		get_template_part( 'components/header/header', 'toggle' );
	}

	/**
	 * Site branding.
	 *
	 * @return string html
	 */
	public static function do_site_branding() {
		get_template_part( 'components/header/site', 'branding' );
	}

	/**
	 * Header search.
	 *
	 * @return string html
	 */
	public static function do_header_search() {
		get_template_part( 'components/header/header', 'search' );
	}

	/**
	 * Header navigation.
	 *
	 * @return string html
	 */
	public static function do_header_navigation() {
		get_template_part( 'components/menus/menu', 'primary' );
	}

}
