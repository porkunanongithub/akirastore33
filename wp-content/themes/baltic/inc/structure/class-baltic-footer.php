<?php
/**
 * Baltic footer structure.
 *
 * @package Baltic
 */

/**
 * Baltic structure footer class.
 *
 * @since  1.0.0
 */
class Baltic_Footer {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Footer
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Footer An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'baltic_footer_before', array( __class__, 'footer_social' ), 10 );
		add_action( 'baltic_footer_before', array( __class__, 'payment_icons' ), 20 );
		add_action( 'baltic_footer', array( __class__, 'footer_copyright' ), 20 );
		add_action( 'baltic_footer', array( __class__, 'footer_menu' ), 30 );
		add_action( 'wp_footer', array( __class__, 'return_top' ), 10 );

	}

	public static function footer_social() {
		get_template_part( 'components/menus/menu', 'social' );
	}

	/**
	 * Footer menu.
	 *
	 * @return string footer menu html
	 */
	public static function footer_menu() {
		get_template_part( 'components/menus/menu', 'secondary' );
	}

	/**
	 * Footer text.
	 *
	 * @return string output of footer text
	 */
	public static function footer_copyright() {
		get_template_part( 'components/footer/footer', 'copyright' );
	}

	/**
	 * Return to top link.
	 *
	 * @return string html return to top link
	 */
	public static function return_top() {

		if ( is_customize_preview() ) {
			echo '<div class="return-to-top-customizer">';
		}

		if ( Baltic_Options::get_option( 'return_top' ) == true ) {
			get_template_part( 'components/footer/return', 'top' );
		}

		if ( is_customize_preview() ) {
			echo '</div>';
		}

	}

	public static function payment_icons() {
		get_template_part( 'components/footer/payment', 'icons' );
	}

}
