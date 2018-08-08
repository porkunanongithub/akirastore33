<?php
/**
 * Baltic sidebar structure
 *
 * @package Baltic
 */

/**
 * Baltic structure sidebar class.
 *
 * @since  1.0.0
 */
class Baltic_Sidebar {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Sidebar
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Sidebar An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * class __construct.
	 */
	public function __construct() {

		add_action( 'baltic_primary_after', array( __class__, 'do_sidebar' ), 10 );
		add_action( 'baltic_footer_before', array( __class__, 'do_sidebar_footer' ), 20 );

	}

	/**
	 * Get sidebar.
	 *
	 * @return string html
	 */
	public static function do_sidebar() {

		if ( Baltic_Layout::get_layout() == 'full-width' || Baltic_Layout::get_layout() == 'narrow' ) {
			return;
		}

		get_sidebar();

	}

	/**
	 * Get sidebar footer.
	 *
	 * @return string html
	 */
	public static function do_sidebar_footer() {
		get_sidebar( 'footer' );
	}

}
